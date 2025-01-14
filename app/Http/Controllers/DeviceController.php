<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    /**
     * Display a listing of the devices.
     */
    public function index()
    {
        $devices = Device::all();
        return view('itasset.device', compact('devices'));
    }

    /**
     * Store a newly created device in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_device' => 'required|string|max:255',
            'brand_device' => 'required|string|max:255',
            'type_device' => 'required|string|max:255',
            'year_device' => 'required|numeric',
            'os_device' => 'required|string|max:255',
            'processor_device' => 'required|string|max:255',
            'ram_device' => 'required|numeric',
            'disk_device' => 'required|string|max:255',
        ]);
    
        Device::create([
            'name_device' => $request->name_device,
            'brand_device' => $request->brand_device,
            'type_device' => $request->type_device,
            'year_device' => $request->year_device,
            'os_device' => $request->os_device,
            'processor_device' => $request->processor_device,
            'ram_device' => $request->ram_device,
            'disk_device' => $request->disk_device,
        ]);
    
        return redirect()->back()->with('success', 'Perangkat berhasil ditambahkan!');
    }


    /**
     * Display the specified device.
     */
    public function show($id)
    {
        $device = Device::find($id);

        if (!$device) {
            return response()->json(['message' => 'Device not found.'], 404);
        }

        return response()->json($device);
    }

    /**
     * Update the specified device in storage.
     */
    public function update(Request $request, $id)
    {
        $device = Device::find($id);

        if (!$device) {
            return response()->json(['message' => 'Device not found.'], 404);
        }

        $validated = $request->validate([
            'name_device' => 'nullable|string|max:255',
            'brand_device' => 'nullable|string|max:255',
            'type_device' => 'nullable|string|max:255',
            'year_device' => 'nullable|integer|min:1900|max:' . date('Y'),
            'os_device' => 'nullable|string|max:255',
            'processor_device' => 'nullable|string|max:255',
            'ram_device' => 'nullable|integer|min:0',
            'disk_device' => 'nullable|integer|min:0',
        ]);

        $device->update($validated);

        return response()->json(['message' => 'Device updated successfully.', 'device' => $device]);
    }

    /**
     * Remove the specified device from storage.
     */
    public function destroy($id)
    {
        $device = Device::find($id);

        if (!$device) {
            return response()->json(['message' => 'Device not found.'], 404);
        }

        $device->delete();

        return response()->json(['message' => 'Device deleted successfully.']);
    }
}
