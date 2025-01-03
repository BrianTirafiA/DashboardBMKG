<?php

namespace App\Http\Controllers;

use App\Models\station;
use Illuminate\Http\Request;

class PinController extends Controller
{
    public function showMap()
    {
        $stations = Station::getUniqueStations();

        // Pass data to the Blade view
        return view('home', compact('stations'));
    }
}
