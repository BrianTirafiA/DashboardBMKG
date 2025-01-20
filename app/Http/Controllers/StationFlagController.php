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
        // Extract flags dynamically based on the column pattern "_flag_0_percent"
        $flags = DB::table('information_schema.columns')
            ->selectRaw("DISTINCT split_part(column_name, '_', 1) AS flag")
            ->where('table_name', 'station_flag_summary') // Ensure this is your actual table name
            ->where('column_name', 'LIKE', '%_flag_0_percent') // Match columns with the pattern
            ->pluck('flag');

        // Fetch distinct machine types and provinces
        $machineTypes = Station::distinct()->pluck('tipe_station');
        $provinces = Station::distinct()->pluck('nama_propinsi');

        // Dropdown options
        $dropdownOptions = [
            'flags' => $flags,
            'machineTypes' => $machineTypes,
            'provinces' => $provinces,
        ];

        // Retrieve filters from request
        $flag = $request->get('flag', 'all');
        $type = $request->get('type', 'all');
        $province = $request->get('province', 'all');

        // Build query with filters
        $stationsQuery = Station::query();

        // Apply flag filter
        if ($flag !== 'all') {
            // Dynamically find all valid columns for the selected flag
            $columns = Schema::getColumnListing('station_flag_summary'); // Replace with your table name
            $validColumns = collect($columns)->filter(function ($column) use ($flag) {
                return preg_match("/^{$flag}_\\d+_percent$/", $column); // Match columns like rr_flag_0_percent
            });

            if ($validColumns->isNotEmpty()) {
                $stationsQuery->where(function ($query) use ($validColumns) {
                    foreach ($validColumns as $column) {
                        $query->orWhere($column, '!=', null);
                    }
                });
            }
        }

        // Apply type filter
        if ($type !== 'all') {
            $stationsQuery->where('tipe_station', $type);
        }

        // Apply province filter
        if ($province !== 'all') {
            $stationsQuery->where('nama_propinsi', $province);
        }

        $stations = $stationsQuery->get();

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
                'lat' => $station->latt_station ?? 0, // Replace with actual latitude field
                'lon' => $station->long_station ?? 0, // Replace with actual longitude field
                'overall_values' => $overallValues,
            ];
        });

        // Group data by `tipe_station` and normalize percentages
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

        // Calculate average overall percentages
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

        return view('home', compact('markerData', 'tipeStationData', 'overallSum', 'dropdownOptions'));
    }
}
