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
        return view('itAsset.device', compact('devices'));
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
            'name_device' => 'required|string|max:255' . $id,
            'brand_device' => 'required|string|max:255',
            'type_device' => 'required|string|max:255',
            'year_device' => 'required|numeric',
            'os_device' => 'required|string|max:255',
            'processor_device' => 'required|string|max:255',
            'ram_device' => 'required|numeric',
            'disk_device' => 'required|string|max:255',
        ]);

        $device = Device::findOrFail($id);

        $device->update([
            'name_device' => $request->name_device,
            'brand_device' => $request->brand_device,
            'type_device' => $request->type_device,
            'year_device' => $request->year_device,
            'os_device' => $request->os_device,
            'processor_device' => $request->processor_device,
            'ram_device' => $request->ram_device,
            'disk_device' => $request->disk_device,
        ]);

        return redirect()->route(route: 'device.index')->with('success', 'Pengguna berhasil diperbarui.');
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

        return redirect()->back()->with('success', 'Perangkat berhasil ditambahkan!');
    }

    public function adminindex(Request $request)
    {
        $query = $request->input('search'); // Ambil input pencarian

        // Jika query ada, tambahkan kondisi pencarian, jika tidak, ambil semua data
        $device = Device::when($query, function ($queryBuilder) use ($query) {
            $queryBuilder->where('name_device', 'ILIKE', "%{$query}%")
                ->orWhere('type_device', 'ILIKE', "%{$query}%");
        })->paginate(8);

        return view('itasset.device', compact('device', 'query'));
    }

}
