<?php

namespace App\Http\Controllers;

use App\Models\Station;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class StationFlagController extends Controller
{
    public function filter(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = Station::query();

        if (empty($startDate) || empty($endDate)) {
            $endDate = now()->format('Y-m-d'); // Today's date
            $startDate = now()->subDays(6)->format('Y-m-d'); // 7 days ago
        }
    
        $query = Station::query();
    
        // Filter by date range
        $query->whereBetween('date_only', [$startDate, $endDate]);
        $stations = $query->orderBy('name_station', 'ASC')
            ->orderBy('date_only', 'DESC')
            ->get();

        // Send all rows from the database
        $markerData = $stations->map(fn ($station) => $station->toArray());

        // Dropdown options
        $columns = Schema::getColumnListing('station_flag_summary');
        $flagOptions = collect($columns)->filter(fn ($column) => preg_match('/^(.*?)_flag_0_percent$/', $column))
            ->map(fn ($column) => preg_replace('/_flag_0_percent$/', '_flag', $column))
            ->unique()->values();

        $machineTypes = Station::select('tipe_station')->distinct()->pluck('tipe_station');
        $provinces = Station::select('nama_propinsi')->distinct()->pluck('nama_propinsi');

        $dropdownOptions = [
            'flags' => $flagOptions,
            'machineTypes' => $machineTypes,
            'provinces' => $provinces,
        ];

        return view('home', compact('markerData', 'dropdownOptions'));
    }

    public function downloadPdf(Request $request)
    {
        $stationName = $request->input('station_name');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $selectedFlag = $request->input('selected_flag', 'overall_value');
        $chartImage = $request->input('chart_image');
    
        // Validate input parameters
        if (!$stationName || !$startDate || !$endDate) {
            return response()->json(['error' => 'Invalid parameters. Please provide station_name, start_date, and end_date.'], 400);
        }
    
        // Fetch data from the database
        $stations = Station::where('name_station', $stationName)
            ->whereBetween('date_only', [$startDate, $endDate])
            ->orderBy('date_only', 'ASC')
            ->get();
    
        // Check if data exists
        if ($stations->isEmpty()) {
            return response()->json(['error' => 'No data found for the given station and date range.'], 404);
        }
    
        // Prepare data for the PDF
        $validData = [];
        $invalidData = [];
        $missingData = [];
    
        foreach ($stations as $station) {
            // Dynamically fetch the valid column based on selectedFlag
            $validColumn = "{$selectedFlag}_0_percent";
    
            // Dynamically fetch invalid flags 1 to 7
            $invalidFlags = [];
            for ($i = 1; $i <= 7; $i++) {
                $invalidFlags["Flag $i"] = $station->{"{$selectedFlag}_{$i}_percent"} ?? 0;
            }
    
            // Fetch the missing data column
            $missingColumn = "{$selectedFlag}_9_percent";
    
            // Calculate the total sum to normalize percentages
            $total = $station->$validColumn + array_sum($invalidFlags) + $station->$missingColumn;
    
            // Ensure total is greater than zero to avoid division by zero
            if ($total > 0) {
                $validData[$station->date_only] = ($station->$validColumn / $total) * 100;
                $invalidData[$station->date_only] = array_map(fn ($value) => ($value / $total) * 100, $invalidFlags);
                $missingData[$station->date_only] = ($station->$missingColumn / $total) * 100;
            } else {
                $validData[$station->date_only] = 0;
                $invalidData[$station->date_only] = array_map(fn ($value) => 0, $invalidFlags);
                $missingData[$station->date_only] = 0;
            }
        }
    
        // Prepare data for the chart
        $chartData = [
            'dates' => array_keys($validData),
            'valid' => array_values($validData),
            'invalid' => array_map(function ($flags) {
                return array_sum($flags);
            }, $invalidData),
            'missing' => array_values($missingData),
        ];
    
        // Generate PDF using the Blade view
        $pdf = Pdf::loadView('station-report', [
            'stationName' => $stationName,
            'validData' => $validData,
            'invalidData' => $invalidData,
            'missingData' => $missingData,
            'chartData' => $chartData,
            'chartImage' => $chartImage,
        ]);
    
        // Return the PDF for download
        return $pdf->download("Station_Report_{$stationName}.pdf");
    }


}
