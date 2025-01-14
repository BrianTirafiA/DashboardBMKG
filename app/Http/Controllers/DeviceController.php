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

        $device = Device::create($validated);
        return response()->json(['message' => 'Device created successfully.', 'device' => $device], 201);
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
