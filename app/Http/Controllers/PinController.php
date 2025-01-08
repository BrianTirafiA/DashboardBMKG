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

    // Controller to send data to view
    public function showMap(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        
        $addedStations = [];  // Array to track the added stations
        
        if (empty($startDate) || empty($endDate)) {
            $stations = Station::getUniqueStations(null, null); // Pull the latest data
            $distinct_dates = Station::getDistinctDates(); // Get distinct dates for the whole dataset
            
            // Collect station names
            foreach ($stations as $station) {
                $addedStations[] = $station->name_station;
            }
        } else {
            if ($startDate === $endDate) {
                $stations = Station::getUniqueStations($startDate, $startDate); // Single day filter
                $distinct_dates = Station::getDistinctDates($startDate, $startDate); // Get distinct dates for the selected day
                
                // Collect station names
                foreach ($stations as $station) {
                    $addedStations[] = $station->name_station;
                }
            } else {
                $stations = Station::getUniqueStations($startDate, $endDate); // Date range filter
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
    
        // Pass the added stations count to the view
        return view('home', compact('stations', 'distinct_dates', 'addedStationsCount', 'stationCounts'));
    }
}
