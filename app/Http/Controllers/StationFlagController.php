<?php

namespace App\Http\Controllers;

use App\Models\station_flag_summary;
use Illuminate\Http\Request;

class StationFlagController extends Controller
{
    public function showMap(Request $request)
{
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');

    $result = station_flag_summary::getStationSummary($startDate, $endDate);
    $stations = $result['stations'];
    $fetchCount = $result['fetchCount'];

    $distinct_dates = station_flag_summary::getDistinctDates($startDate, $endDate);
    $stationCounts = station_flag_summary::getTipeStationCounts();
    $dropdownOptions = station_flag_summary::getDropdownOptions();

    $addedStationsCount = count(array_unique(array_column($stations, 'name_station')));

    return view('home', compact('stations', 'distinct_dates', 'addedStationsCount', 'fetchCount', 'stationCounts', 'dropdownOptions'));
}

}
