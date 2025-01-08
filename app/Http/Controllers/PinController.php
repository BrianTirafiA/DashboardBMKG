<?php

namespace App\Http\Controllers;

use App\Models\station;
use Illuminate\Http\Request;

class PinController extends Controller
{
    // // Controller to send data to view(With AllFlags)[Not currently in use]
    // public function showMap()
    // {
    //      $stations = station::getUniqueStations(); // Retrieve stations or any data you need
    //      $allFlagsData  = station::AllFlags(); // Call your method for all flags

    //      return view('home', compact('stations', 'allFlagsData'));
    // }

    public function showMap(Request $request)
{
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');

    $addedStations = []; // Array to track the added stations

    if (empty($startDate) || empty($endDate)) {
        $result = Station::getUniqueStations(null, null); // Pull the latest data
        $stations = $result['stations'];
        $fetchCount = $result['fetchCount'];

        $distinct_dates = Station::getDistinctDates(); // Get distinct dates for the whole dataset

        // Collect station names
        foreach ($stations as $station) {
            $addedStations[] = $station->name_station;
        }
    } else {
        if ($startDate === $endDate) {
            $result = Station::getUniqueStations($startDate, $startDate); // Single day filter
            $stations = $result['stations'];
            $fetchCount = $result['fetchCount'];

            $distinct_dates = Station::getDistinctDates($startDate, $startDate); // Get distinct dates for the selected day

            // Collect station names
            foreach ($stations as $station) {
                $addedStations[] = $station->name_station;
            }
        } else {
            $result = Station::getUniqueStations($startDate, $endDate); // Date range filter
            $stations = $result['stations'];
            $fetchCount = $result['fetchCount'];

            $distinct_dates = Station::getDistinctDates($startDate, $endDate); // Get distinct dates for the range

            // Collect station names
            foreach ($stations as $station) {
                $addedStations[] = $station->name_station;
            }
        }
    }

    $stationCounts = Station::getTipeStationCounts();

    // Remove duplicate station names and count them
    $addedStationsCount = count(array_unique($addedStations));

    // Fetch dropdown options dynamically
    $flags = \DB::select("
        SELECT column_name 
        FROM information_schema.columns 
        WHERE table_name = 'stations' AND column_name LIKE '%_flag'
    ");
    $machineTypes = \DB::table('stations')
        ->select('tipe_station')
        ->distinct()
        ->pluck('tipe_station');
    $provinces = \DB::table('stations')
        ->select('nama_propinsi')
        ->distinct()
        ->pluck('nama_propinsi');

    $dropdownOptions = [
        'flags' => array_map(fn($flag) => $flag->column_name, $flags),
        'machineTypes' => $machineTypes,
        'provinces' => $provinces,
    ];

    // Pass the added stations count and fetch count to the view
    return view('home', compact('stations', 'distinct_dates', 'addedStationsCount', 'fetchCount', 'stationCounts', 'dropdownOptions'));
}


    // Controller to send data to view
    // public function showMap(Request $request)
    // {
    //     $startDate = $request->input('start_date');
    //     $endDate = $request->input('end_date');
    
    //     $addedStations = []; // Array to track the added stations
    
    //     if (empty($startDate) || empty($endDate)) {
    //         $stations = Station::getUniqueStations(null, null); // Pull the latest data
    //         $distinct_dates = Station::getDistinctDates(); // Get distinct dates for the whole dataset
    
    //         // Collect station names
    //         foreach ($stations as $station) {
    //             $addedStations[] = $station->name_station;
    //         }
    //     } else {
    //         if ($startDate === $endDate) {
    //             $stations = Station::getUniqueStations($startDate, $startDate); // Single day filter
    //             $distinct_dates = Station::getDistinctDates($startDate, $startDate); // Get distinct dates for the selected day
    
    //             // Collect station names
    //             foreach ($stations as $station) {
    //                 $addedStations[] = $station->name_station;
    //             }
    //         } else {
    //             $stations = Station::getUniqueStations($startDate, $endDate); // Date range filter
    //             $distinct_dates = Station::getDistinctDates($startDate, $endDate); // Get distinct dates for the range
    
    //             // Collect station names
    //             foreach ($stations as $station) {
    //                 $addedStations[] = $station->name_station;
    //             }
    //         }
    //     }
    
    //     $stationCounts = Station::getTipeStationCounts();
    
    //     // Remove duplicate station names and count them
    //     $addedStationsCount = count(array_unique($addedStations));
    
    //     // Fetch dropdown options dynamically
    //     $flags = \DB::select("
    //         SELECT column_name 
    //         FROM information_schema.columns 
    //         WHERE table_name = 'stations' AND column_name LIKE '%_flag'
    //     ");
    //     $machineTypes = \DB::table('stations')
    //         ->select('tipe_station')
    //         ->distinct()
    //         ->pluck('tipe_station');
    //     $provinces = \DB::table('stations')
    //         ->select('nama_propinsi')
    //         ->distinct()
    //         ->pluck('nama_propinsi');
    
    //     $dropdownOptions = [
    //         'flags' => array_map(fn($flag) => $flag->column_name, $flags),
    //         'machineTypes' => $machineTypes,
    //         'provinces' => $provinces,
    //     ];
    
    //     // Pass the added stations count and dropdown options to the view
    //     return view('home', compact('stations', 'distinct_dates', 'addedStationsCount', 'stationCounts', 'dropdownOptions'));
    // }
    
}
