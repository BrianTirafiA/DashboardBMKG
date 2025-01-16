<?php

namespace App\Http\Controllers;

use App\Models\station;
use Illuminate\Http\Request;

class StationFlagController extends Controller
{
    public function index()
    {
        $stations = Station::all();


    // Prepare data for markers
    $markerData = $stations->map(function ($station) {
        $overallValues = [
            $station->overall_value_0_percent,
            $station->overall_value_1_percent,
            $station->overall_value_2_percent,
            $station->overall_value_3_percent,
            $station->overall_value_4_percent,
            $station->overall_value_5_percent,
            $station->overall_value_6_percent,
            $station->overall_value_7_percent,
            $station->overall_value_8_percent,
            $station->overall_value_9_percent,
        ];

        return [
            'name_station' => $station->name_station,
            'tipe_station' => $station->tipe_station,
            'nama_propinsi' => $station->nama_propinsi,
            'lat' => $station->latt_station, // Assuming the database has latitude
            'lon' => $station->long_station, // Assuming the database has longitude
            'overall_values' => $overallValues,
        ];
    });
    
    // Group data by `tipe_station` and normalize percentages to sum to 100% for each station
    $tipeStationData = $stations->groupBy('tipe_station')->map(function ($group) {
        $sums = [
            'Value 0' => $group->sum('overall_value_0_percent'),
            'Value 1' => $group->sum('overall_value_1_percent'),
            'Value 2' => $group->sum('overall_value_2_percent'),
            'Value 3' => $group->sum('overall_value_3_percent'),
            'Value 4' => $group->sum('overall_value_4_percent'),
            'Value 5' => $group->sum('overall_value_5_percent'),
            'Value 6' => $group->sum('overall_value_6_percent'),
            'Value 7' => $group->sum('overall_value_7_percent'),
            'Value 8' => $group->sum('overall_value_8_percent'),
            'Value 9' => $group->sum('overall_value_9_percent'),
        ];

        $total = array_sum($sums);

        return array_map(function ($value) use ($total) {
            return $total > 0 ? ($value / $total) * 100 : 0;
        }, $sums);
    });
    
        // Second Chart: Average overall percentages across all records
        $overallSum = [
            'Value 0' => $stations->average('overall_value_0_percent'),
            'Value 1' => $stations->average('overall_value_1_percent'),
            'Value 2' => $stations->average('overall_value_2_percent'),
            'Value 3' => $stations->average('overall_value_3_percent'),
            'Value 4' => $stations->average('overall_value_4_percent'),
            'Value 5' => $stations->average('overall_value_5_percent'),
            'Value 6' => $stations->average('overall_value_6_percent'),
            'Value 7' => $stations->average('overall_value_7_percent'),
            'Value 8' => $stations->average('overall_value_8_percent'),
            'Value 9' => $stations->average('overall_value_9_percent'),
        ];
    
        return view('home', compact('markerData', 'tipeStationData', 'overallSum'));
    }
}
