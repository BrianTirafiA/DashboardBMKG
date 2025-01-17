<?php

namespace App\Http\Controllers;

use App\Models\ItemBrand;
use Illuminate\Http\Request;

class ItemBrandController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil input pencarian dari request  
        $search = $request->input('search');

        // Memulai query untuk ItemLocation  
        $item_brands = ItemBrand::query()
            ->when($search, function ($query, $search) {
                return $query->where('name_brand', 'like', "%{$search}%")
                    ->orWhere('origin_brand', 'like', "%{$search}%")
                    ->orWhere('description_brand', 'like', "%{$search}%");
            })
            ->paginate(10);

        // Mengembalikan view dengan data lokasi  
        return view('lending-asset.admin.brand', compact('item_brands'));
    }

    public function store(Request $request)
    {
        // Validasi input  
        $request->validate([
            'name_brand' => 'required|string|max:255',
            'origin_brand' => 'required|string|max:255',
            'description_brand' => 'required|string|max:255',
        ]);

        // Buat Lokasi baru  
        ItemBrand::create([
            'name_brand' => $request->name_brand,
            'origin_brand' => $request->origin_brand,
            'description_brand' => $request->description_brand,
        ]);

        return redirect()->back()->with('success', 'Brand berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $ItemBrand = ItemBrand::findOrFail($id);
        return response()->json($ItemBrand);
    }

    public function update(Request $request, $id)
    {
        // Validasi input    
        $request->validate([
            'name_brand' => 'required|string|max:255',
            'origin_brand' => 'required|string|max:255',
            'description_brand' => 'required|string|max:255',
        ]);

        $ItemBrand = ItemBrand::findOrFail($id);
        $ItemBrand->update([
            'name_brand' => $request->name_brand,
            'origin_brand' => $request->origin_brand,
            'description_brand' => $request->description_brand,
        ]);
      
        return redirect()->back()->with('success', 'Lokasi berhasil diperbarui.');
    }

    public function destroy($id)  
    {  
        $ItemBrand = ItemBrand::findOrFail($id); 
        $ItemBrand->delete();  
        return redirect()->back()->with('success', 'Brand berhasil dihapus.');  
    } 

    public function show($id)
    {
        $ItemBrand = ItemBrand::findOrFail($id);
        return response()->json($ItemBrand);
    }
}
