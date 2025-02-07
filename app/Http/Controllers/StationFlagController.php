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
            // Calculate the total percentage
            $total = $station->overall_value_0_percent +
                     $station->overall_value_1_percent +
                     $station->overall_value_2_percent +
                     $station->overall_value_3_percent +
                     $station->overall_value_4_percent +
                     $station->overall_value_5_percent +
                     $station->overall_value_6_percent +
                     $station->overall_value_7_percent +
                     $station->overall_value_8_percent +
                     $station->overall_value_9_percent;
    
            // Check if total is greater than zero to avoid division by zero
            if ($total > 0) {
                $validData[$station->date_only] = ($station->overall_value_0_percent / $total) * 100;
                $invalidData[$station->date_only] = [
                    'Flag 1' => ($station->overall_value_1_percent / $total) * 100,
                    'Flag 2' => ($station->overall_value_2_percent / $total) * 100,
                    'Flag 3' => ($station->overall_value_3_percent / $total) * 100,
                    'Flag 4' => ($station->overall_value_4_percent / $total) * 100,
                    'Flag 5' => ($station->overall_value_5_percent / $total) * 100,
                    'Flag 6' => ($station->overall_value_6_percent / $total) * 100,
                    'Flag 7' => ($station->overall_value_7_percent / $total) * 100,
                ];
                $missingData[$station->date_only] = ($station->overall_value_9_percent / $total) * 100;
            } else {
                $validData[$station->date_only] = 0;
                $invalidData[$station->date_only] = [
                    'Flag 1' => 0,
                    'Flag 2' => 0,
                    'Flag 3' => 0,
                    'Flag 4' => 0,
                    'Flag 5' => 0,
                    'Flag 6' => 0,
                    'Flag 7' => 0,
                ];
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
        ]);
    
        // Return the PDF for download
        return $pdf->download("Station_Report_{$stationName}.pdf");
    }


}
