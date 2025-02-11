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

        ini_set('max_execution_time', 3600); // Increase execution time
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
        $markerData = $stations->map(fn($station) => $station->toArray());

        // Dropdown options
        $columns = Schema::getColumnListing('station_flag_summary');
        $flagOptions = collect($columns)->filter(fn($column) => preg_match('/^(.*?)_flag_0_percent$/', $column))
            ->map(fn($column) => preg_replace('/_flag_0_percent$/', '_flag', $column))
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

        ini_set('max_execution_time', 3600); // Increase execution time
        $stationName = $request->input('station_name');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $selectedFlag = $request->input('selected_flag', 'overall_value');
        $chartImage = $request->input('chart_image');

        if ($selectedFlag === 'all') {
            $selectedFlag = 'overall_value';
        }
        ;

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
                $validData[$station->date_only] = round(($station->$validColumn / $total) * 100, 2);
                $invalidData[$station->date_only] = array_map(fn($value) => round(($value / $total) * 100, 2), $invalidFlags);
                $missingData[$station->date_only] = round(($station->$missingColumn / $total) * 100, 2);
            } else {
                $validData[$station->date_only] = 0;
                $invalidData[$station->date_only] = array_map(fn($value) => 0, $invalidFlags);
                $missingData[$station->date_only] = 0;
            }
        }

        // Prepare data for the chart
        $chartData = json_encode([
            'dates' => array_keys($validData),
            'valid' => array_map(fn($value) => round($value, 2), array_values($validData)),
            'invalid' => array_map(fn($flags) => round(array_sum($flags), 2), $invalidData),
            'missing' => array_map(fn($value) => round($value, 2), array_values($missingData)),
        ]);


        // Generate PDF using the Blade view
        $pdf = Pdf::loadView('station-report', [
            'stationName' => $stationName,
            'selectedFlag' => $selectedFlag,
            'validData' => $validData,
            'invalidData' => $invalidData,
            'missingData' => $missingData,
            'chartData' => $chartData,
            'chartImage' => $chartImage,
        ]);

        // Return the PDF for download
        return $pdf->download("Station_Report_{$stationName}(Tipe_Data_{$selectedFlag}).pdf");
    }

    public function downloadAllStationsPdf(Request $request)
    {
        ini_set('max_execution_time', 3600); // Increase execution time

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $selectedFlag = $request->input('selected_flag', 'overall_value');
        $type = $request->input('type', 'all');
        $province = $request->input('province', 'all');
        $chart1Image = $request->input('chart_image1');
        $chart2Image = $request->input('chart_image2');

        if ($selectedFlag === 'all') {
            $selectedFlag = 'overall_value';
        }

        // Validate Date Inputs
        if (!$startDate || !$endDate) {
            return response()->json(['error' => 'Please provide start_date and end_date.'], 400);
        }

        // Fetch Stations Based on Filters
        $stations = Station::when($province !== 'all', function ($query) use ($province) {
            return $query->where('nama_propinsi', $province);
        })
            ->when($type !== 'all', function ($query) use ($type) {
                return $query->where('tipe_station', $type);
            })
            ->whereBetween('date_only', [$startDate, $endDate])
            ->orderBy('name_station')
            ->orderBy('date_only', 'ASC')
            ->select([
                'name_station',
                'date_only',
                'tipe_station',
                'overall_value_0_percent',
                'overall_value_1_percent',
                'overall_value_2_percent',
                'overall_value_3_percent',
                'overall_value_4_percent',
                'overall_value_5_percent',
                'overall_value_6_percent',
                'overall_value_7_percent',
                'overall_value_9_percent'
            ])
            ->get();

        // Handle Case Where No Data is Found
        if ($stations->isEmpty()) {
            return response()->json(['error' => 'No data found for the given filters.'], 404);
        }

        // **🔥 Chart 1: Validation by Machine Type**
        $chart1Data = [];
        foreach ($stations as $station) {
            $type = $station->tipe_station;
            if (!isset($chart1Data[$type])) {
                $chart1Data[$type] = [
                    'chart1Valid' => 0,
                    'chart1Invalid' => 0,
                    'chart1Missing' => 0,
                    'total' => 0
                ];
            }

            for ($i = 0; $i <= 9; $i++) {
                $value = $station->{"{$selectedFlag}_{$i}_percent"} ?? 0;
                $chart1Data[$type]['total'] += $value;

                if ($i === 0) {
                    $chart1Data[$type]['chart1Valid'] += $value;
                } elseif ($i >= 1 && $i <= 8) {
                    $chart1Data[$type]['chart1Invalid'] += $value;
                } elseif ($i === 9) {
                    $chart1Data[$type]['chart1Missing'] += $value;
                }
            }
        }

        // Normalize Chart 1 Data to Percentage
        foreach ($chart1Data as &$data) {
            $total = max($data['total'], 1); // Prevent division by zero
            $data['chart1Valid'] = round(($data['chart1Valid'] / $total) * 100, 2);
            $data['chart1Invalid'] = round(($data['chart1Invalid'] / $total) * 100, 2);
            $data['chart1Missing'] = round(($data['chart1Missing'] / $total) * 100, 2);
            unset($data['total']);
        }

        // **🔥 Chart 2: Overall Validation**
        $overallSum = ['chart2Valid' => 0, 'chart2Invalid' => 0, 'chart2Missing' => 0, 'total' => 0];

        foreach ($chart1Data as $typeData) {
            $overallSum['chart2Valid'] += $typeData['chart1Valid'];
            $overallSum['chart2Invalid'] += $typeData['chart1Invalid'];
            $overallSum['chart2Missing'] += $typeData['chart1Missing'];
            $overallSum['total'] += 100; // Since each type's values already sum to 100%
        }

        // Normalize Overall Data
        $chart2Data = [
            'chart2Valid' => round(($overallSum['chart2Valid'] / max($overallSum['total'], 1)) * 100, 2),
            'chart2Invalid' => round(($overallSum['chart2Invalid'] / max($overallSum['total'], 1)) * 100, 2),
            'chart2Missing' => round(($overallSum['chart2Missing'] / max($overallSum['total'], 1)) * 100, 2),
        ];

        // Existing Report Data Logic
        $groupedStations = $stations->groupBy('name_station');
        $reportData = [];

        foreach ($groupedStations as $stationName => $stationData) {
            $validData = [];
            $invalidData = [];
            $missingData = [];

            foreach ($stationData as $station) {
                $validColumn = "{$selectedFlag}_0_percent";
                $invalidFlags = [];
                for ($i = 1; $i <= 7; $i++) {
                    $invalidFlags["Flag $i"] = $station->{"{$selectedFlag}_{$i}_percent"} ?? 0;
                }
                $missingColumn = "{$selectedFlag}_9_percent";

                $total = ($station->$validColumn ?? 0) + array_sum($invalidFlags) + ($station->$missingColumn ?? 0);

                if ($total > 0) {
                    $validData[$station->date_only] = round(($station->$validColumn / $total) * 100, 2);
                    $invalidData[$station->date_only] = array_map(fn($value) => round(($value / $total) * 100, 2), $invalidFlags);
                    $missingData[$station->date_only] = round(($station->$missingColumn / $total) * 100, 2);
                } else {
                    $validData[$station->date_only] = 0;
                    $invalidData[$station->date_only] = array_map(fn($value) => 0, $invalidFlags);
                    $missingData[$station->date_only] = 0;
                }
            }

            $reportData[] = [
                'stationName' => $stationName,
                'validData' => $validData,
                'invalidData' => $invalidData,
                'missingData' => $missingData,
            ];
        }

        // Generate PDF Using Blade Template
        $pdf = Pdf::loadView('all-station-report', [
            'reportData' => $reportData,
            'selectedFlag' => $selectedFlag,
            'type' => $type,
            'province' => $province,
            'chartTypeData' => $chart1Data,   // Renamed for uniqueness
            'chartOverallData' => $chart2Data, // Renamed for uniqueness
            'chart1Image' => $chart1Image,
            'chart2Image' => $chart2Image,
        ]);

        // Return the PDF for Download
        return $pdf->download("All_Stations_Report(Tipe_Data_{$selectedFlag};Tipe_Alat_{$type};Provinsi_{$province}).pdf");
    }
}
