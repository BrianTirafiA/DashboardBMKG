<?php

namespace App\Http\Controllers;

use App\Models\ItemCategory;
use Illuminate\Http\Request;

class ItemCategoryController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil input pencarian dari request  
        $search = $request->input('search');

        // Memulai query untuk ItemLocation  
        $item_categories = ItemCategory::query()
            ->when($search, function ($query, $search) {
                return $query->where('name_category', 'like', "%{$search}%")
                    ->orWhere('description_category', 'like', "%{$search}%");
            })
            ->paginate(10);

        // Mengembalikan view dengan data lokasi  
        return view('lending-asset.admin.kategori', compact('item_categories'));
    }

    public function store(Request $request)
    {
        // Validasi input  
        $request->validate([
            'name_category' => 'required|string|max:255',
            'description_category' => 'required|string|max:255',
        ]);

        // Buat Lokasi baru  
        ItemCategory::create([
            'name_category' => $request->name_category,
            'description_category' => $request->description_category
        ]);

        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $ItemCategory = ItemCategory::findOrFail($id);
        return response()->json($ItemCategory);
    }

    public function update(Request $request, $id)
    {
        // Validasi input    
        $request->validate([
            'name_category' => 'required|string|max:255',
            'description_category' => 'required|string|max:255',
        ]);

        $ItemCategory = ItemCategory::findOrFail($id);
        $ItemCategory->update([
            'name_category' => $request->name_category,
            'description_category' => $request->description_category,
        ]);
      
        return redirect()->back()->with('success', 'Lokasi berhasil diperbarui.');
    }

    public function destroy($id)  
    {  
        $ItemCategory = ItemCategory::findOrFail($id); 
        $ItemCategory->delete();  
        return redirect()->back()->with('success', 'Kategori berhasil dihapus.');  
    } 

    public function show($id)
    {
        $ItemCategory = ItemCategory::findOrFail($id);
        return response()->json($ItemCategory);
    }
}
