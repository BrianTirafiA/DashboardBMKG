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

    // Method to get the latest unique stations
    public static function getUniqueStations()
    {
        return \DB::select("
            SELECT DISTINCT ON (name_station) 
                name_station, latt_station, long_station, rr_flag 
            FROM stations
            ORDER BY name_station ASC, tanggal DESC
        ");
    }

}
