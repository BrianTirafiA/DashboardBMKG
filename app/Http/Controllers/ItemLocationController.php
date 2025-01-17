<?php

namespace App\Http\Controllers;
use App\Models\ItemCategory;
use App\Models\ItemLocation;
use App\Models\ItemStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class ItemLocationController extends Controller
{
    public function locationindex(Request $request)
    {
        // Mengambil input pencarian dari request  
        $search = $request->input('search');

        // Memulai query untuk ItemLocation  
        $item_locations = ItemLocation::query()
            ->when($search, function ($query, $search) {
                return $query->where('nama_lokasi', 'like', "%{$search}%")
                    ->orWhere('alamat_lokasi', 'like', "%{$search}%")
                    ->orWhere('penanggung_jawab', 'like', "%{$search}%")
                    ->orWhere('latitude', 'like', "%{$search}%")
                    ->orWhere('longitude', 'like', "%{$search}%");
            })
            ->paginate(10);

        // Mengembalikan view dengan data lokasi  
        return view('lending-asset.admin.lokasi', compact('item_locations'));
    }

    public function store(Request $request)
    {
        // Validasi input  
        $request->validate([
            'nama_lokasi' => 'required|string|max:255',
            'alamat_lokasi' => 'required|string|max:255',
            'penanggung_jawab' => 'required|string|max:255',
            'latitude' => 'required|string|max:20',
            'longitude' => 'required|string|max:20',
        ]);

        // Buat Lokasi baru  
        ItemLocation::create([
            'nama_lokasi' => $request->nama_lokasi,
            'alamat_lokasi' => $request->alamat_lokasi,
            'penanggung_jawab' => $request->penanggung_jawab,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return redirect()->back()->with('success', 'Lokasi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $ItemLoc = ItemLocation::findOrFail($id);
        return response()->json($ItemLoc);
    }

    public function update(Request $request, $id)
    {
        // Validasi input    
        $request->validate([
            'nama_lokasi' => 'required|string|max:255',
            'alamat_lokasi' => 'required|string|max:255',
            'penanggung_jawab' => 'required|string|max:255',
            'latitude' => 'required|string|max:20',
            'longitude' => 'required|string|max:20',
        ]);

        $ItemLoc = ItemLocation::findOrFail($id);
        $ItemLoc->update([
            'nama_lokasi' => $request->nama_lokasi,
            'alamat_lokasi' => $request->alamat_lokasi,
            'penanggung_jawab' => $request->penanggung_jawab,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);
      
        return redirect()->back()->with('success', 'Lokasi berhasil diperbarui.');
    }

    public function destroy($id)  
    {  
        $ItemLoc = ItemLocation::findOrFail($id); 
        $ItemLoc->delete();  
        return redirect()->back()->with('success', 'Pengguna berhasil dihapus.');  
    }  

    public function show($id)
    {
        $ItemLoc = ItemLocation::findOrFail($id);
        return response()->json($ItemLoc);
    }


}
