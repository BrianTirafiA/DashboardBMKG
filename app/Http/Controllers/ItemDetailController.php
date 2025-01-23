<?php

namespace App\Http\Controllers;

use App\Models\ItemDetail;
use App\Models\ItemCategory;
use App\Models\ItemLocation;
use App\Models\ItemStatus;
use App\Models\ItemBrand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\ImageManager;


class ItemDetailController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil input pencarian dari request  
        $search = $request->input('search');

        // Memulai query untuk ItemDetail  
        $item_details = ItemDetail::with('brand', 'category', 'status', 'location')
            ->when($search, function ($query, $search) {
                return $query->where('nama_item', 'like', "%{$search}%")
                    ->orWhere('type_item', 'like', "%{$search}%")
                    ->orWhere('nama_vendor', 'like', "%{$search}%")
                    ->orWhereHas('brand', function ($q) use ($search) {
                        $q->where('name_brand', 'like', "%{$search}%");
                    })
                    ->orWhereHas('category', function ($q) use ($search) {
                        $q->where('name_category', 'like', "%{$search}%");
                    })
                    ->orWhereHas('status', function ($q) use ($search) {
                        $q->where('name_status', 'like', "%{$search}%");
                    })
                    ->orWhereHas('location', function ($q) use ($search) {
                        $q->where('nama_lokasi', 'like', "%{$search}%");
                    });
            })
            ->paginate(10);

        $item_brands = ItemBrand::all();
        $item_categories = ItemCategory::all();
        $item_status = ItemStatus::all();
        $item_locations = ItemLocation::all();

        // Mengembalikan view dengan data item  
        return view('lending-asset.admin.items', compact('item_details', 'item_brands', 'item_categories', 'item_status', 'item_locations'));
    }

    public function store(Request $request)
    {
        // Validasi input  
        $request->validate([
            'nama_item' => 'nullable|string|max:255',
            'type_item' => 'nullable|string|max:255',
            'brand_item_id' => 'nullable|exists:item_brands,id',
            'tanggal_pengadaan' => 'nullable|date',
            'nama_vendor' => 'nullable|string|max:255',
            'jumlah_item' => 'nullable|integer',
            'kategori_item_id' => 'nullable|exists:item_categories,id',
            'status_item_id' => 'nullable|exists:item_statuses,id',
            'lokasi_item_id' => 'nullable|exists:item_locations,id',
            'image1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image4' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Buat Item baru  
        $itemDetail = ItemDetail::create([
            'nama_item' => $request->nama_item,
            'type_item' => $request->type_item,
            'brand_item_id' => $request->brand_item_id,
            'tanggal_pengadaan' => $request->tanggal_pengadaan,
            'nama_vendor' => $request->nama_vendor,
            'jumlah_item' => $request->jumlah_item,
            'kategori_item_id' => $request->kategori_item_id,
            'status_item_id' => $request->status_item_id,
            'lokasi_item_id' => $request->lokasi_item_id,
        ]);

        // Menyimpan gambar jika ada  
        $this->saveImages($request, $itemDetail);

        // Mengembalikan respons JSON  
        return redirect()->back()->with('success', 'Item berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $itemDetail = ItemDetail::findOrFail($id);
        return response()->json($itemDetail);
    }

    public function update(Request $request, $id)
    {
        // Validasi input  
        $request->validate([
            'nama_item' => 'required|string|max:255',
            'type_item' => 'required|string|max:255',
            'brand_item_id' => 'required|exists:item_brands,id',
            'tanggal_pengadaan' => 'nullable|date',
            'nama_vendor' => 'nullable|string|max:255',
            'jumlah_item' => 'required|integer',
            'kategori_item_id' => 'required|exists:item_categories,id',
            'status_item_id' => 'required|exists:item_statuses,id',
            'lokasi_item_id' => 'required|exists:item_locations,id',
            'image1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image4' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $itemDetail = ItemDetail::findOrFail($id);
        $itemDetail->update([
            'nama_item' => $request->nama_item,
            'type_item' => $request->type_item,
            'brand_item_id' => $request->brand_item_id,
            'tanggal_pengadaan' => $request->tanggal_pengadaan,
            'nama_vendor' => $request->nama_vendor,
            'jumlah_item' => $request->jumlah_item,
            'kategori_item_id' => $request->kategori_item_id,
            'status_item_id' => $request->status_item_id,
            'lokasi_item_id' => $request->lokasi_item_id,
        ]);

        // Menyimpan gambar jika ada  
        $this->saveImages($request, $itemDetail);

        return redirect()->back()->with('success', 'Item berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $itemDetail = ItemDetail::findOrFail($id);
        // Hapus gambar dari storage jika ada  
        $this->deleteImages($itemDetail);
        $itemDetail->delete();
        return redirect()->back()->with('success', 'Item berhasil dihapus.');
    }

    private function saveImages(Request $request, ItemDetail $itemDetail)
    {
        // Menyimpan gambar jika ada            
        foreach (['image1', 'image2', 'image3', 'image4'] as $imageField) {
            if ($request->hasFile($imageField)) {
                // Hapus gambar lama jika ada            
                if ($itemDetail->{$imageField}) {
                    Storage::disk('public')->delete($itemDetail->{$imageField});
                }

                // Membaca gambar baru        
                $image = Image::read($request->file($imageField));

                // Buat nama file yang lebih baik    
                $imageName = 'item_' . $itemDetail->id . '_' . $imageField . '_' . time() . '.' . $request->file($imageField)->getClientOriginalExtension();
                $destinationPath = storage_path('app/public/item_images/');

                // Buat direktori jika belum ada    
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }

                // Simpan path gambar ke model        
                $itemDetail->{$imageField} = 'item_images/' . $imageName;

                // Ubah ukuran gambar dan simpan      
                $image->resize(500, 500);
                $image->save($destinationPath . $imageName, 75); // Simpan dengan kualitas 75      
            }
        }

        // Simpan perubahan hanya jika ada gambar baru yang diunggah          
        if ($request->hasFile('image1') || $request->hasFile('image2') || $request->hasFile('image3') || $request->hasFile('image4')) {
            $itemDetail->save();
        }
    }

    private function deleteImages(ItemDetail $itemDetail)
    {
        // Hapus gambar dari storage  
        foreach (['image1', 'image2', 'image3', 'image4'] as $imageField) {
            if ($itemDetail->{$imageField}) {
                Storage::disk('public')->delete($itemDetail->{$imageField});
            }
        }
    }

    public function deleteImage(Request $request, $id, $imageField)
    {
        $itemDetail = ItemDetail::findOrFail($id);

        if ($itemDetail->{$imageField}) {
            Storage::disk('public')->delete($itemDetail->{$imageField});
            $itemDetail->{$imageField} = null;
            $itemDetail->save();
        }

        return redirect()->back()->with('success', 'Gambar berhasil dihapus.');
    }
}
