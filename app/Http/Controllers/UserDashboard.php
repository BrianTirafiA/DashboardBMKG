<?php

namespace App\Http\Controllers;
use App\Models\ItemDetail;
use App\Models\ItemCategory;
use App\Models\ItemLocation;
use App\Models\ItemStatus;
use App\Models\ItemBrand;
use App\Models\LoanRequest;
use App\Models\LoanRequestItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserDashboard extends Controller
{
    public function itemindex(Request $request)
    {
        // Mengambil input pencarian dan filter dari request  
        $search = $request->input('search');
        $brandFilter = $request->input('brand');
        $categoryFilter = $request->input('category');
        $statusFilter = $request->input('status');
        $locationFilter = $request->input('location');

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
            ->when($brandFilter, function ($query, $brandFilter) {
                return $query->whereHas('brand', function ($q) use ($brandFilter) {
                    $q->where('id', $brandFilter);
                });
            })
            ->when($categoryFilter, function ($query, $categoryFilter) {
                return $query->whereHas('category', function ($q) use ($categoryFilter) {
                    $q->where('id', $categoryFilter);
                });
            })
            ->when($statusFilter, function ($query, $statusFilter) {
                return $query->whereHas('status', function ($q) use ($statusFilter) {
                    $q->where('id', $statusFilter);
                });
            })
            ->when($locationFilter, function ($query, $locationFilter) {
                return $query->whereHas('location', function ($q) use ($locationFilter) {
                    $q->where('id', $locationFilter);
                });
            })
            ->paginate(10);

        // Mengambil URL gambar
        foreach ($item_details as $item) {
            $item->image1_url = Storage::url($item->image1);
            $item->image2_url = Storage::url($item->image2);
            $item->image3_url = Storage::url($item->image3);
            $item->image4_url = Storage::url($item->image4);
        }

        $categories = ItemCategory::all();
        $brands = ItemBrand::all();
        $locations = ItemLocation::all();
        $status = ItemStatus::all();

        // Mengembalikan view dengan data item  
        return view('lending-asset.user.user-dashboard', compact('item_details', 'brands', 'categories', 'status', 'locations'));
    }

    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'durasi_peminjaman' => 'required|integer|min:1',
            'alasan_peminjaman' => 'required|string',
            'tanggal_pengajuan' => 'required|date',
            'berkas_pendukung' => 'nullable|file',
            'items' => 'required|array',
            'items.*.item_details_id' => 'required|exists:item_details,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);
    
        // Mulai transaksi database
        DB::beginTransaction();
    
        try {
            // Cek ketersediaan item sebelum menyimpan permohonan
            foreach ($request->items as $item) {
                $itemDetail = ItemDetail::lockForUpdate()->find($item['item_details_id']);
    
                if (!$itemDetail) {
                    return redirect()->back()->with('error', 'Item tidak ditemukan.');
                }
    
                // Hitung total borrowed_quantity setelah ditambah peminjaman
                $total_borrowed = $itemDetail->borrowed_quantity + $item['quantity'];
    
                // Validasi apakah item masih tersedia
                if ($total_borrowed > $itemDetail->jumlah_item) {
                    return redirect()->back()->with('error', "Barang '{$itemDetail->nama_item}' tidak tersedia untuk dipinjam.");
                }
            }
    
            // Simpan permohonan peminjaman
            $loanRequest = LoanRequest::create([
                'user_id' => $request->user_id,
                'durasi_peminjaman' => $request->durasi_peminjaman,
                'alasan_peminjaman' => $request->alasan_peminjaman,
                'tanggal_pengajuan' => $request->tanggal_pengajuan,
                'berkas_pendukung' => $request->file('berkas_pendukung') ? $request->file('berkas_pendukung')->store('uploads') : null,
                'approval_status' => 'pending',
            ]);
    
            // Simpan item peminjaman dan update borrowed_quantity
            foreach ($request->items as $item) {
                LoanRequestItem::create([
                    'loan_request_id' => $loanRequest->id,
                    'item_details_id' => $item['item_details_id'],
                    'quantity' => $item['quantity'],
                ]);
    
                // Update jumlah barang yang sedang dipinjam
                $itemDetail = ItemDetail::lockForUpdate()->find($item['item_details_id']);
                if ($itemDetail) {
                    $itemDetail->borrowed_quantity += $item['quantity'];
                    $itemDetail->save();
                }
            }
    
            // Commit transaksi jika semua berhasil
            DB::commit();
    
            return redirect()->back()->with('success', 'Permohonan peminjaman berhasil ditambahkan.');
        } catch (\Exception $e) {
            // Rollback jika terjadi error
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan, silakan coba lagi.');
        }
    }
    
}
