<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class station extends Model
{
    use HasFactory;
    protected $table = 'station_flag_summary'; // The name of the view
    protected $fillable = [
        'date_only','name_station','tipe_station','nama_propinsi','total_records',
        'rr_flag_0_percent','rr_flag_1_percent','rr_flag_2_percent','rr_flag_3_percent','rr_flag_4_percent',
        'rr_flag_5_percent','rr_flag_6_percent','rr_flag_7_percent','rr_flag_8_percent','rr_flag_9_percent',
        'pp_air_flag_0_percent','pp_air_flag_1_percent','pp_air_flag_2_percent','pp_air_flag_3_percent','pp_air_flag_4_percent',
        'pp_air_flag_5_percent','pp_air_flag_6_percent','pp_air_flag_7_percent','pp_air_flag_8_percent','pp_air_flag_9_percent',
        'rh_avg_flag_0_percent','rh_avg_flag_1_percent','rh_avg_flag_2_percent','rh_avg_flag_3_percent','rh_avg_flag_4_percent',
        'rh_avg_flag_5_percent','rh_avg_flag_6_percent','rh_avg_flag_7_percent','rh_avg_flag_8_percent','rh_avg_flag_9_percent',
        'sr_avg_flag_0_percent','sr_avg_flag_1_percent','sr_avg_flag_2_percent','sr_avg_flag_3_percent','sr_avg_flag_4_percent',
        'sr_avg_flag_5_percent','sr_avg_flag_6_percent','sr_avg_flag_7_percent','sr_avg_flag_8_percent','sr_avg_flag_9_percent',
        'sr_max_flag_0_percent','sr_max_flag_1_percent','sr_max_flag_2_percent','sr_max_flag_3_percent','sr_max_flag_4_percent',
        'sr_max_flag_5_percent','sr_max_flag_6_percent','sr_max_flag_7_percent','sr_max_flag_8_percent','sr_max_flag_9_percent',
        'nr_flag_0_percent','nr_flag_1_percent','nr_flag_2_percent','nr_flag_3_percent','nr_flag_4_percent',
        'nr_flag_5_percent','nr_flag_6_percent','nr_flag_7_percent','nr_flag_8_percent','nr_flag_9_percent',
        'wd_avg_flag_0_percent','wd_avg_flag_1_percent','wd_avg_flag_2_percent','wd_avg_flag_3_percent','wd_avg_flag_4_percent',
        'wd_avg_flag_5_percent','wd_avg_flag_6_percent','wd_avg_flag_7_percent','wd_avg_flag_8_percent','wd_avg_flag_9_percent',
        'ws_avg_flag_0_percent','ws_avg_flag_1_percent','ws_avg_flag_2_percent','ws_avg_flag_3_percent','ws_avg_flag_4_percent',
        'ws_avg_flag_5_percent','ws_avg_flag_6_percent','ws_avg_flag_7_percent','ws_avg_flag_8_percent','ws_avg_flag_9_percent',
        'ws_max_flag_0_percent','ws_max_flag_1_percent','ws_max_flag_2_percent','ws_max_flag_3_percent','ws_max_flag_4_percent',
        'ws_max_flag_5_percent','ws_max_flag_6_percent','ws_max_flag_7_percent','ws_max_flag_8_percent','ws_max_flag_9_percent',
        'wl_flag_0_percent','wl_flag_1_percent','wl_flag_2_percent','wl_flag_3_percent','wl_flag_4_percent',
        'wl_flag_5_percent','wl_flag_6_percent','wl_flag_7_percent','wl_flag_8_percent','wl_flag_9_percent',
        'tt_air_avg_flag_0_percent','tt_air_avg_flag_1_percent','tt_air_avg_flag_2_percent','tt_air_avg_flag_3_percent','tt_air_avg_flag_4_percent',
        'tt_air_avg_flag_5_percent','tt_air_avg_flag_6_percent','tt_air_avg_flag_7_percent','tt_air_avg_flag_8_percent','tt_air_avg_flag_9_percent',
        'tt_air_min_flag_0_percent','tt_air_min_flag_1_percent','tt_air_min_flag_2_percent','tt_air_min_flag_3_percent','tt_air_min_flag_4_percent',
        'tt_air_min_flag_5_percent','tt_air_min_flag_6_percent','tt_air_min_flag_7_percent','tt_air_min_flag_8_percent','tt_air_min_flag_9_percent',
        'tt_air_max_flag_0_percent','tt_air_max_flag_1_percent','tt_air_max_flag_2_percent','tt_air_max_flag_3_percent','tt_air_max_flag_4_percent',
        'tt_air_max_flag_5_percent','tt_air_max_flag_6_percent','tt_air_max_flag_7_percent','tt_air_max_flag_8_percent','tt_air_max_flag_9_percent',
        'tt_sea_flag_0_percent','tt_sea_flag_1_percent','tt_sea_flag_2_percent','tt_sea_flag_3_percent','tt_sea_flag_4_percent',
        'tt_sea_flag_5_percent','tt_sea_flag_6_percent','tt_sea_flag_7_percent','tt_sea_flag_8_percent','tt_sea_flag_9_percent',
        'ws_50cm_flag_0_percent','ws_50cm_flag_1_percent','ws_50cm_flag_2_percent','ws_50cm_flag_3_percent','ws_50cm_flag_4_percent',
        'ws_50cm_flag_5_percent','ws_50cm_flag_6_percent','ws_50cm_flag_7_percent','ws_50cm_flag_8_percent','ws_50cm_flag_9_percent',
        'wl_pan_flag_0_percent','wl_pan_flag_1_percent','wl_pan_flag_2_percent','wl_pan_flag_3_percent','wl_pan_flag_4_percent',
        'wl_pan_flag_5_percent','wl_pan_flag_6_percent','wl_pan_flag_7_percent','wl_pan_flag_8_percent','wl_pan_flag_9_percent',
        'ev_pan_flag_0_percent','ev_pan_flag_1_percent','ev_pan_flag_2_percent','ev_pan_flag_3_percent','ev_pan_flag_4_percent',
        'ev_pan_flag_5_percent','ev_pan_flag_6_percent','ev_pan_flag_7_percent','ev_pan_flag_8_percent','ev_pan_flag_9_percent',
        'tt_pan_flag_0_percent','tt_pan_flag_1_percent','tt_pan_flag_2_percent','tt_pan_flag_3_percent','tt_pan_flag_4_percent',
        'tt_pan_flag_5_percent','tt_pan_flag_6_percent','tt_pan_flag_7_percent','tt_pan_flag_8_percent','tt_pan_flag_9_percent',
        'overall_value_0_percent','overall_value_1_percent','overall_value_2_percent','overall_value_3_percent','overall_value_4_percent',
        'overall_value_5_percent','overall_value_6_percent','overall_value_7_percent','overall_value_8_percent','overall_value_9_percent'
    ];
}
