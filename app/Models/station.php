<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class station extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal', 'long_station', 'latt_station', 'name_station', 'nama_propinsi', 'nama_kota', 
        'tipe_station', 'rr_flag', 'pp_air_flag', 'rh_avg_flag', 'sr_avg_flag', 'sr_max_flag',
        'nr_flag', 'wd_avg_flag', 'ws_avg_flag', 'ws_max_flag', 'wl_flag', 'tt_air_avg_flag', 
        'tt_air_min_flag', 'tt_air_max_flag', 'tt_sea_flag', 'ws_50cm_flag', 'wl_pan_flag', 
        'ev_pan_flag', 'tt_pan_flag',
    ];

    public static function getUniqueStations($startDate = null, $endDate = null)
    {
        $query = "
            SELECT DISTINCT ON (name_station, DATE(tanggal)) 
                tanggal, name_station, tipe_station, nama_propinsi, latt_station, long_station, rr_flag, pp_air_flag, rh_avg_flag, 
                sr_avg_flag, sr_max_flag, nr_flag, wd_avg_flag, ws_avg_flag, ws_max_flag, wl_flag, tt_air_avg_flag, 
                tt_air_min_flag, tt_air_max_flag, tt_sea_flag, ws_50cm_flag, wl_pan_flag, ev_pan_flag, tt_pan_flag 
            FROM stations
        ";
    
        // If dates are provided, adjust to include the full range for both start and end date
        if ($startDate && $endDate) {
            // Parse the start and end dates
            $startDateTime = \Carbon\Carbon::parse($startDate)->startOfDay(); // Start of the day (00:00:00)
            $endDateTime = \Carbon\Carbon::parse($endDate)->endOfDay(); // End of the day (23:59:59)
            
            $query .= " WHERE tanggal >= ? AND tanggal <= ?"; // Use <= to include the entire end date
        }
    
        // Order by station name, date (descending), and time (descending) to get the latest data for each station
        $query .= " ORDER BY name_station ASC, DATE(tanggal) DESC, tanggal DESC";
    
        // Execute the query with or without date parameters
        if ($startDate && $endDate) {
            $stations = \DB::select($query, [$startDateTime, $endDateTime]);
        } else {
            $stations = \DB::select($query);
        }
    
        // Calculate average flag value for each station
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
    
            // Calculate the average of the numeric flag values, if any are present
            if (count($flags) > 0) {
                $station->average_flag = round(array_sum($flags) / count($flags), 0);
            } else {
                $station->average_flag = 0; // Set to 0 if no valid flags exist
            }
        }
    
        return $stations;
    }
    
    
    public static function getDistinctDates($startDate = null, $endDate = null)
{
    $query = "
        SELECT DISTINCT DATE(tanggal) as date
        FROM stations
    ";

    // If dates are provided, add the WHERE clause to filter by date range
    if ($startDate && $endDate) {
        $query .= " WHERE tanggal BETWEEN ? AND ?";
    }

    // Execute the query with or without date parameters
    if ($startDate && $endDate) {
        return \DB::select($query, [$startDate, $endDate]);
    } else {
        return \DB::select($query);
    }
}


    
    
    //correct
    //Method to get the latest unique stations with average flag value
    // public static function getUniqueStations()
    // {
    //     $stations = \DB::select("
    //         SELECT DISTINCT ON (name_station) 
    //             tanggal, name_station, tipe_station, nama_propinsi, latt_station, long_station, rr_flag, pp_air_flag, rh_avg_flag, sr_avg_flag, 
    //             sr_max_flag, nr_flag, wd_avg_flag, ws_avg_flag, ws_max_flag, wl_flag, tt_air_avg_flag, 
    //             tt_air_min_flag, tt_air_max_flag, tt_sea_flag, ws_50cm_flag, wl_pan_flag, ev_pan_flag, tt_pan_flag 
    //         FROM stations
    //         ORDER BY name_station ASC, tanggal DESC
    //     ");

    //     // Calculate average flag value for each station
    //     foreach ($stations as &$station) {
    //         // Explicitly cast each flag to a float to ensure proper calculations
    //         $flags = array_filter([
    //             (float) $station->rr_flag,
    //             (float) $station->pp_air_flag,
    //             (float) $station->rh_avg_flag,
    //             (float) $station->sr_avg_flag,
    //             (float) $station->sr_max_flag,
    //             (float) $station->nr_flag,
    //             (float) $station->wd_avg_flag,
    //             (float) $station->ws_avg_flag,
    //             (float) $station->ws_max_flag,
    //             (float) $station->wl_flag,
    //             (float) $station->tt_air_avg_flag,
    //             (float) $station->tt_air_min_flag,
    //             (float) $station->tt_air_max_flag,
    //             (float) $station->tt_sea_flag,
    //             (float) $station->ws_50cm_flag,
    //             (float) $station->wl_pan_flag,
    //             (float) $station->ev_pan_flag,
    //             (float) $station->tt_pan_flag
    //         ], function ($value) {
    //             return is_numeric($value); // Keep only numeric values
    //         });

    //         // Calculate the average of the numeric flag values, if any are present
    //         if (count($flags) > 0) {
    //             $station->average_flag = round(array_sum($flags) / count($flags), 0); // rounding to 2 decimal places
    //         } else {
    //             $station->average_flag = 0; // Set to 0 if no valid flags exist
    //         }
    //     }

    //     return $stations;
    // }

    public static function AllFlags()
    {
        $allflags = \DB::select("
            SELECT
                name_station, tipe_station, latt_station, long_station, rr_flag, pp_air_flag, rh_avg_flag, sr_avg_flag, 
                sr_max_flag, nr_flag, wd_avg_flag, ws_avg_flag, ws_max_flag, wl_flag, tt_air_avg_flag, 
                tt_air_min_flag, tt_air_max_flag, tt_sea_flag, ws_50cm_flag, wl_pan_flag, ev_pan_flag, tt_pan_flag 
            FROM stations
            ORDER BY name_station ASC, tanggal DESC
        ");

        // Initialize an array to store all flags' data
    $allFlagsData = [];

    // Iterate through the station data
    foreach ($allflags as $station) {
        // Combine each flag value with its respective station info
        $allFlagsData[] = [
            'name_station' => $station->name_station,
            'tipe_station' => $station->tipe_station,
            'latt_station' => $station->latt_station,
            'long_station' => $station->long_station,
            'flags' => [
                'rr_flag' => $station->rr_flag,
                'pp_air_flag' => $station->pp_air_flag,
                'rh_avg_flag' => $station->rh_avg_flag,
                'sr_avg_flag' => $station->sr_avg_flag,
                'sr_max_flag' => $station->sr_max_flag,
                'nr_flag' => $station->nr_flag,
                'wd_avg_flag' => $station->wd_avg_flag,
                'ws_avg_flag' => $station->ws_avg_flag,
                'ws_max_flag' => $station->ws_max_flag,
                'wl_flag' => $station->wl_flag,
                'tt_air_avg_flag' => $station->tt_air_avg_flag,
                'tt_air_min_flag' => $station->tt_air_min_flag,
                'tt_air_max_flag' => $station->tt_air_max_flag,
                'tt_sea_flag' => $station->tt_sea_flag,
                'ws_50cm_flag' => $station->ws_50cm_flag,
                'wl_pan_flag' => $station->wl_pan_flag,
                'ev_pan_flag' => $station->ev_pan_flag,
                'tt_pan_flag' => $station->tt_pan_flag
            ]
        ];
    }

    // Return the combined flag data
    return $allFlagsData;

    }

    //Method to get the latest unique stations
    // public static function getUniqueStations()
    // {
    //     return \DB::select("
    //         SELECT DISTINCT ON (name_station) 
    //             name_station, latt_station, long_station, rr_flag 
    //         FROM stations
    //         ORDER BY name_station ASC, tanggal DESC
    //     ");
    // }

}
