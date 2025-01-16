<?php

namespace App\Http\Controllers;

use App\Models\TypeDevice;
use Illuminate\Http\Request;

class TypeDeviceController extends Controller
{
    // Menampilkan semua data type_device
    public function index()
    {
        $typeDevices = TypeDevice::all();
        return view('form-add-device', compact('typeDevices'));
        
    }

    // Menampilkan form untuk membuat type_device baru
    public function create()
    {
        return view('type_device.create'); // Menampilkan form input
    }

    // Menyimpan data type_device baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name_type' => 'required|string|max:255',
        ]);

        // Menyimpan data baru
        TypeDevice::create($request->all());

        // Redirect setelah menyimpan data
        return redirect()->back()->with('success', 'Perangkat berhasil ditambahkan!');
    }

    // Menampilkan form untuk mengedit type_device
    public function edit($id)
    {
        $typeDevice = TypeDevice::findOrFail($id);
        return view('type_device.edit', compact('typeDevice'));
    }

    // Memperbarui data type_device
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'name_type' => 'required|string|max:255',
        ]);

        // Mencari data type_device berdasarkan ID dan memperbarui
        $typeDevice = TypeDevice::findOrFail($id);
        $typeDevice->update($request->all());

        // Redirect setelah memperbarui data
        return redirect()->route('type_device.index')->with('success', 'Type Device updated successfully.');
    }

    // Menghapus data type_device
    public function destroy($id)
    {
        $typeDevice = TypeDevice::findOrFail($id);
        $typeDevice->delete();

        return redirect()->route('type_device.index')->with('success', 'Type Device deleted successfully.');
    }
}
