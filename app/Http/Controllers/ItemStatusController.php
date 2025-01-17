<?php

namespace App\Http\Controllers;

use App\Models\ItemStatus;
use Illuminate\Http\Request;

class ItemStatusController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil input pencarian dari request  
        $search = $request->input('search');

        // Memulai query untuk ItemLocation  
        $item_statuses = ItemStatus::query()
            ->when($search, function ($query, $search) {
                return $query->where('name_status', 'like', "%{$search}%")
                    ->orWhere('description_status', 'like', "%{$search}%");
            })
            ->paginate(10);

        // Mengembalikan view dengan data lokasi  
        return view('lending-asset.admin.status', compact('item_statuses'));
    }

    public function store(Request $request)
    {
        // Validasi input  
        $request->validate([
            '_status_status' => 'required|string|max:255',
            'description_status' => 'required|string|max:255',
        ]);

        // Buat Lokasi baru  
        ItemStatus::create([
            'name_status' => $request->name_status,
            'description_status' => $request->description_status,
        ]);

        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $ItemStatus = ItemStatus::findOrFail($id);
        return response()->json($ItemStatus);
    }

    public function update(Request $request, $id)
    {
        // Validasi input    
        $request->validate([
            'name_status' => 'required|string|max:255',
            'description_status' => 'required|string|max:255',
        ]);

        $ItemStatus = ItemStatus::findOrFail($id);
        $ItemStatus->update([
            'name_status' => $request->name_status,
            'description_status' => $request->description_status,
        ]);
      
        return redirect()->back()->with('success', 'Lokasi berhasil diperbarui.');
    }

    public function destroy($id)  
    {  
        $ItemStatus = ItemStatus::findOrFail($id); 
        $ItemStatus->delete();  
        return redirect()->back()->with('success', 'Kategori berhasil dihapus.');  
    } 

    public function show($id)
    {
        $ItemStatus = ItemStatus::findOrFail($id);
        return response()->json($ItemStatus);
    }

}
