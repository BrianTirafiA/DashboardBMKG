<?php

namespace App\Http\Controllers;

use App\Models\Device;

class RackController extends Controller
{
    public function showRak()
    {
        // Ambil semua perangkat dari database (atau data lain yang sesuai dengan kebutuhan)
        $devices = Device::all();

        // Kirim data perangkat ke view
        return view('rak', compact('devices'));
    }
}
