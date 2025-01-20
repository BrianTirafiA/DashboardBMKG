<?php

namespace App\Http\Controllers;

use App\Models\station;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class StationFlagController extends Controller
{
    public function filter(Request $request)
    {
        // Retrieve filters from the request
        $flag = $request->get('flag', 'all');
        $type = $request->get('type', 'all');
        $province = $request->get('province', 'all');
    
        // Build query for stations
        $stationsQuery = Station::query();

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        if ($startDate && $endDate) {
            $stationsQuery->whereBetween('date_only', [$startDate, $endDate]); // Replace 'date_column' with your actual column
        }
    
        // Apply filters
        if ($flag !== 'all') {
            $columns = Schema::getColumnListing('station_flag_summary');
            $validColumns = collect($columns)->filter(function ($column) use ($flag) {
                return preg_match("/^{$flag}_\\d+_percent$/", $column);
            });
    
            if ($validColumns->isNotEmpty()) {
                $stationsQuery->where(function ($query) use ($validColumns) {
                    foreach ($validColumns as $column) {
                        $query->orWhere($column, '!=', null);
                    }
                });
            }
        }
    
        if ($type !== 'all') {
            $stationsQuery->where('tipe_station', $type);
        }
    
        if ($province !== 'all') {
            $stationsQuery->where('nama_propinsi', $province);
        }
    
        $stations = $stationsQuery->get();
    
        // Prepare data for map markers
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
                'lat' => $station->latt_station ?? 0,
                'lon' => $station->long_station ?? 0,
                'overall_values' => $overallValues,
            ];
        });
    
        // Group data for charts
        $tipeStationData = $stations->groupBy('tipe_station')->map(function ($group) {
            $sums = [];
            for ($i = 0; $i < 10; $i++) {
                $sums["Value $i"] = $group->sum("overall_value_{$i}_percent");
            }
            $total = array_sum($sums);
            return array_map(function ($value) use ($total) {
                return $total > 0 ? ($value / $total) * 100 : 0;
            }, $sums);
        });
    
        $overallSum = [];
        for ($i = 0; $i < 10; $i++) {
            $overallSum["Value $i"] = $stations->average("overall_value_{$i}_percent");
        }
    
        return response()->json([
            'markerData' => $markerData,
            'tipeStationData' => $tipeStationData,
            'overallSum' => $overallSum,
        ]);
    }
    
}
