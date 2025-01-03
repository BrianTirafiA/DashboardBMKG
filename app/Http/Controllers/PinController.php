<?php

namespace App\Http\Controllers;

use App\Models\station;
use Illuminate\Http\Request;

class PinController extends Controller
{
    public function showMap()
    {
        // Retrieve all necessary data for the map
        $stations = station::getUniqueStations(); // Retrieve stations or any data you need

        // Optionally, fetch all flags data as well
        // $allFlagsData  = station::AllFlags(); // Call your method for all flags

        //return view('home', compact('stations', 'allFlagsData'));

    return view('home', compact('stations'));
    }

}
