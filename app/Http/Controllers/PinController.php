<?php

namespace App\Http\Controllers;

use App\Models\station;
use Illuminate\Http\Request;

class PinController extends Controller
{

    public function showMap(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $addedStations = [];
        $fetchCount = 0;

        if (empty($startDate) || empty($endDate)) {
            $stations = $this->getUniqueStations(null, null);
        } else if ($startDate === $endDate) {
            $stations = $this->getUniqueStations($startDate, $startDate);
        } else {
            $stations = $this->getUniqueStations($startDate, $endDate);
        }

        $fetchCount = count($stations);
        $distinct_dates = $this->getDistinctDates($startDate, $endDate);
        foreach ($stations as $station) {
            $addedStations[] = $station->name_station;
        }

        $stationCounts = $this->getTipeStationCounts();
        $dropdownOptions = $this->getDropdownOptions();

        $addedStationsCount = count(array_unique($addedStations));

        return view('home', compact('stations', 'distinct_dates', 'addedStationsCount', 'fetchCount', 'stationCounts', 'dropdownOptions'));
    }

    private function getUniqueStations($startDate = null, $endDate = null)
    {
        if ($startDate && $endDate) {
            $startDateTime = \Carbon\Carbon::parse($startDate)->startOfDay();
            $endDateTime = \Carbon\Carbon::parse($endDate)->endOfDay();

            $query = "
                WITH ranked_stations AS (
                    SELECT 
                        tanggal,
                        name_station,
                        tipe_station,
                        nama_propinsi,
                        latt_station,
                        long_station,
                        rr_flag,
                        pp_air_flag,
                        rh_avg_flag,
                        sr_avg_flag,
                        sr_max_flag,
                        nr_flag,
                        wd_avg_flag,
                        ws_avg_flag,
                        ws_max_flag,
                        wl_flag,
                        tt_air_avg_flag,
                        tt_air_min_flag,
                        tt_air_max_flag,
                        tt_sea_flag,
                        ws_50cm_flag,
                        wl_pan_flag,
                        ev_pan_flag,
                        tt_pan_flag,
                        ROW_NUMBER() OVER (
                            PARTITION BY name_station, DATE(tanggal) 
                            ORDER BY tanggal DESC
                        ) AS rank
                    FROM stations
                    WHERE tanggal >= ? AND tanggal <= ?
                )
                SELECT * 
                FROM ranked_stations
                WHERE rank = 1
                ORDER BY name_station ASC, DATE(tanggal) DESC
            ";

            $stations = DB::select($query, [$startDateTime, $endDateTime]);
        } else {
            $query = "
                SELECT DISTINCT ON (name_station) 
                    tanggal, name_station, tipe_station, nama_propinsi, latt_station, long_station, rr_flag, pp_air_flag, 
                    rh_avg_flag, sr_avg_flag, sr_max_flag, nr_flag, wd_avg_flag, ws_avg_flag, ws_max_flag, wl_flag, 
                    tt_air_avg_flag, tt_air_min_flag, tt_air_max_flag, tt_sea_flag, ws_50cm_flag, wl_pan_flag, 
                    ev_pan_flag, tt_pan_flag
                FROM stations
                ORDER BY name_station ASC, tanggal DESC
            ";

            $stations = DB::select($query);
        }

        foreach ($stations as &$station) {
            $flags = array_filter([
                (float) $station->rr_flag,
                (float) $station->pp_air_flag,
                (float) $station->rh_avg_flag,
                (float) $station->sr_avg_flag,
                (float) $station->sr_max_flag,
                (float) $station->nr_flag,
                (float) $station->wd_avg_flag,
                (float) $station->ws_avg_flag,
                (float) $station->ws_max_flag,
                (float) $station->wl_flag,
                (float) $station->tt_air_avg_flag,
                (float) $station->tt_air_min_flag,
                (float) $station->tt_air_max_flag,
                (float) $station->tt_sea_flag,
                (float) $station->ws_50cm_flag,
                (float) $station->wl_pan_flag,
                (float) $station->ev_pan_flag,
                (float) $station->tt_pan_flag
            ], function ($value) {
                return is_numeric($value);
            });

            if (count($flags) > 0) {
                $station->average_flag = round(array_sum($flags) / count($flags), 0);
            } else {
                $station->average_flag = 9;
            }
        }

        return $stations;
    }

    private function getDistinctDates($startDate = null, $endDate = null)
    {
        $query = "
            SELECT DISTINCT DATE(tanggal) as date
            FROM stations
        ";

        if ($startDate && $endDate) {
            $query .= " WHERE tanggal BETWEEN ? AND ?";
            return DB::select($query, [$startDate, $endDate]);
        } else {
            return DB::select($query);
        }
    }

    private function getTipeStationCounts()
    {
        $query = "
            WITH latest_stations AS (
                SELECT DISTINCT ON (name_station)
                    name_station, tipe_station
                FROM stations
                ORDER BY name_station ASC, DATE(tanggal) DESC, tanggal DESC
            )
            SELECT tipe_station, COUNT(*) AS count
            FROM latest_stations
            GROUP BY tipe_station
            ORDER BY count DESC
        ";

        return DB::select($query);
    }

    private function getDropdownOptions()
    {
        $flags = DB::select("SELECT column_name FROM information_schema.columns WHERE table_name = 'stations' AND column_name LIKE '%_flag'");
        $machineTypes = DB::table('stations')->select('tipe_station')->distinct()->pluck('tipe_station');
        $provinces = DB::table('stations')->select('nama_propinsi')->distinct()->pluck('nama_propinsi');

        return [
            'flags' => array_map(fn($flag) => $flag->column_name, $flags),
            'machineTypes' => $machineTypes,
            'provinces' => $provinces,
        ];
    }
    // // Controller to send data to view(With AllFlags)[Not currently in use]
    // public function showMap()
    // {
    //      $stations = station::getUniqueStations(); // Retrieve stations or any data you need
    //      $allFlagsData  = station::AllFlags(); // Call your method for all flags

    //      return view('home', compact('stations', 'allFlagsData'));
    // }


//     public function showMap(Request $request)
// {
//     $startDate = $request->input('start_date');
//     $endDate = $request->input('end_date');

//     $addedStations = []; // Array to track the added stations

//     if (empty($startDate) || empty($endDate)) {
//         $result = Station::getUniqueStations(null, null); // Pull the latest data
//         $stations = $result['stations'];
//         $fetchCount = $result['fetchCount'];

//         $distinct_dates = Station::getDistinctDates(); // Get distinct dates for the whole dataset

//         // Collect station names
//         foreach ($stations as $station) {
//             $addedStations[] = $station->name_station;
//         }
//     } else {
//         if ($startDate === $endDate) {
//             $result = Station::getUniqueStations($startDate, $startDate); // Single day filter
//             $stations = $result['stations'];
//             $fetchCount = $result['fetchCount'];

//             $distinct_dates = Station::getDistinctDates($startDate, $startDate); // Get distinct dates for the selected day

//             // Collect station names
//             foreach ($stations as $station) {
//                 $addedStations[] = $station->name_station;
//             }
//         } else {
//             $result = Station::getUniqueStations($startDate, $endDate); // Date range filter
//             $stations = $result['stations'];
//             $fetchCount = $result['fetchCount'];

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

//     // Pass the added stations count and fetch count to the view
//     return view('home', compact('stations', 'distinct_dates', 'addedStationsCount', 'fetchCount', 'stationCounts', 'dropdownOptions'));
// }


    // //Controller to send data to view
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
