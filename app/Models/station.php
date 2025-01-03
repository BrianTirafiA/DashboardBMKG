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

    // Method to get the latest unique stations with average flag value
    public static function getUniqueStations()
    {
        $stations = \DB::select("
            SELECT DISTINCT ON (name_station) 
                name_station, tipe_station, latt_station, long_station, rr_flag, pp_air_flag, rh_avg_flag, sr_avg_flag, 
                sr_max_flag, nr_flag, wd_avg_flag, ws_avg_flag, ws_max_flag, wl_flag, tt_air_avg_flag, 
                tt_air_min_flag, tt_air_max_flag, tt_sea_flag, ws_50cm_flag, wl_pan_flag, ev_pan_flag, tt_pan_flag 
            FROM stations
            ORDER BY name_station ASC, tanggal DESC
        ");

        // Calculate average flag value for each station
        foreach ($stations as &$station) {
            // Explicitly cast each flag to a float to ensure proper calculations
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
                return is_numeric($value); // Keep only numeric values
            });

            // Calculate the average of the numeric flag values, if any are present
            if (count($flags) > 0) {
                $station->average_flag = round(array_sum($flags) / count($flags), 0); // rounding to 2 decimal places
            } else {
                $station->average_flag = 0; // Set to 0 if no valid flags exist
            }
        }

        return $stations;
    }

    // public static function AllFlags()
    // {
    //     $allflags = \DB::select("
    //         SELECT
    //             name_station, tipe_station, latt_station, long_station, rr_flag, pp_air_flag, rh_avg_flag, sr_avg_flag, 
    //             sr_max_flag, nr_flag, wd_avg_flag, ws_avg_flag, ws_max_flag, wl_flag, tt_air_avg_flag, 
    //             tt_air_min_flag, tt_air_max_flag, tt_sea_flag, ws_50cm_flag, wl_pan_flag, ev_pan_flag, tt_pan_flag 
    //         FROM stations
    //         ORDER BY name_station ASC, tanggal DESC
    //     ");

    //     // Initialize an array to store all flags' data
    // $allFlagsData = [];

    // // Iterate through the station data
    // foreach ($allflags as $station) {
    //     // Combine each flag value with its respective station info
    //     $allFlagsData[] = [
    //         'name_station' => $station->name_station,
    //         'tipe_station' => $station->tipe_station,
    //         'latt_station' => $station->latt_station,
    //         'long_station' => $station->long_station,
    //         'flags' => [
    //             'rr_flag' => $station->rr_flag,
    //             'pp_air_flag' => $station->pp_air_flag,
    //             'rh_avg_flag' => $station->rh_avg_flag,
    //             'sr_avg_flag' => $station->sr_avg_flag,
    //             'sr_max_flag' => $station->sr_max_flag,
    //             'nr_flag' => $station->nr_flag,
    //             'wd_avg_flag' => $station->wd_avg_flag,
    //             'ws_avg_flag' => $station->ws_avg_flag,
    //             'ws_max_flag' => $station->ws_max_flag,
    //             'wl_flag' => $station->wl_flag,
    //             'tt_air_avg_flag' => $station->tt_air_avg_flag,
    //             'tt_air_min_flag' => $station->tt_air_min_flag,
    //             'tt_air_max_flag' => $station->tt_air_max_flag,
    //             'tt_sea_flag' => $station->tt_sea_flag,
    //             'ws_50cm_flag' => $station->ws_50cm_flag,
    //             'wl_pan_flag' => $station->wl_pan_flag,
    //             'ev_pan_flag' => $station->ev_pan_flag,
    //             'tt_pan_flag' => $station->tt_pan_flag
    //         ]
    //     ];
    // }

    // // Return the combined flag data
    // return $allFlagsData;

    // }

    // Method to get the latest unique stations
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
