<?php

namespace App\Http\Controllers;

use App\Models\Station;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class StationFlagController extends Controller
{
    public function filter(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = Station::query();

        if (empty($startDate) || empty($endDate)) {
            $endDate = now()->format('Y-m-d'); // Today's date
            $startDate = now()->subDays(6)->format('Y-m-d'); // 7 days ago
        }
    
        $query = Station::query();
    
        // Filter by date range
        $query->whereBetween('date_only', [$startDate, $endDate]);
        $stations = $query->orderBy('name_station', 'ASC')
            ->orderBy('date_only', 'DESC')
            ->get();

        // Send all rows from the database
        $markerData = $stations->map(fn ($station) => $station->toArray());

        // Dropdown options
        $columns = Schema::getColumnListing('station_flag_summary');
        $flagOptions = collect($columns)->filter(fn ($column) => preg_match('/^(.*?)_flag_0_percent$/', $column))
            ->map(fn ($column) => preg_replace('/_flag_0_percent$/', '_flag', $column))
            ->unique()->values();

        $machineTypes = Station::select('tipe_station')->distinct()->pluck('tipe_station');
        $provinces = Station::select('nama_propinsi')->distinct()->pluck('nama_propinsi');

        $dropdownOptions = [
            'flags' => $flagOptions,
            'machineTypes' => $machineTypes,
            'provinces' => $provinces,
        ];

        return view('home', compact('markerData', 'dropdownOptions'));
    }
}
