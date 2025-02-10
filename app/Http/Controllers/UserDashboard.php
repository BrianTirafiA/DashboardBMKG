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

        // Jika kategori yang dipilih adalah "Layanan", redirect ke halaman /user/layanan
        if ($categoryFilter) {
            $category = ItemCategory::find($categoryFilter);
            if ($category && $category->name_category === 'Layanan') {
                return redirect('/user/layanan');
            }
        }

        // Memulai query untuk ItemDetail  
        $item_details = ItemDetail::with('brand', 'category', 'status', 'location')
            ->whereDoesntHave('category', function ($query) {
                $query->where('name_category', 'Layanan'); // Filter berdasarkan kategori "Layanan"
            })
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


    public function layananindex(Request $request)
    {
        // Mengambil input pencarian dan filter dari request  
        $search = $request->input('search');
        $brandFilter = $request->input('brand');
        $categoryFilter = $request->input('category');
        $statusFilter = $request->input('status');
        $locationFilter = $request->input('location');

        $categories = ItemCategory::all();
        $brands = ItemBrand::all();
        $locations = ItemLocation::all();
        $status = ItemStatus::all();

        // Memulai query untuk ItemDetail  
        $item_details = ItemDetail::with('brand', 'category', 'status', 'location')
            ->whereHas('category', function ($query) {
                $query->where('name_category', 'Layanan'); // Filter berdasarkan kategori "Layanan"
            })
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


        // Mengembalikan view dengan data item  
        return view('lending-asset.user.user-layanan', compact('item_details', 'brands', 'categories', 'status', 'locations'));
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
                'berkas_pendukung' => $request->file('berkas_pendukung') ? $request->file('berkas_pendukung')->store('berkas_pendukung', 'public') : null,
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

    public function layananstore(Request $request)
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
            // Simpan permohonan peminjaman
            $loanRequest = LoanRequest::create([
                'user_id' => $request->user_id,
                'durasi_peminjaman' => $request->durasi_peminjaman,
                'alasan_peminjaman' => $request->alasan_peminjaman,
                'tanggal_pengajuan' => $request->tanggal_pengajuan,
                'berkas_pendukung' => $request->file('berkas_pendukung') ? $request->file('berkas_pendukung')->store('berkas_pendukung', 'public') : null,
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

    public function returned(Request $request, $loanRequestId)
    {
        // Validasi input
        $request->validate([
            'approval_status' => 'required|in:approved,rejected,returned',
        ]);

        // Mulai transaksi database
        DB::beginTransaction();

        try {
            $loanRequest = LoanRequest::findOrFail($loanRequestId);

            // Jika status diubah menjadi 'returned', maka kurangi borrowed_quantity
            if ($request->approval_status === 'returned') {
                foreach ($loanRequest->loanRequestItems as $loanItem) {
                    $itemDetail = ItemDetail::lockForUpdate()->find($loanItem->item_details_id);
                    if ($itemDetail) {
                        $itemDetail->borrowed_quantity -= $loanItem->quantity;
                        $itemDetail->save();
                    }
                }
            }

            // Perbarui status peminjaman
            $loanRequest->approval_status = $request->approval_status;
            $loanRequest->save();

            // Commit transaksi
            DB::commit();

            return redirect()->back()->with('success', 'Status peminjaman berhasil diperbarui.');
        } catch (\Exception $e) {
            // Rollback jika terjadi error
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan, silakan coba lagi.');
        }
    }

    public function storefromcart(Request $request)
    {
        // Validasi data
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'durasi_peminjaman' => 'required|integer|min:1',
            'alasan_peminjaman' => 'required|string',
            'tanggal_pengajuan' => 'required|date',
            'berkas_pendukung' => 'nullable|file',
            'items' => 'required|array',
            'items.*.item_id' => 'required|exists:items,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        // Simpan permohonan ke dalam loan_request
        $loanRequest = LoanRequest::create([
            'user_id' => $request->user_id,
            'durasi_peminjaman' => $request->durasi_peminjaman,
            'alasan_peminjaman' => $request->alasan_peminjaman,
            'tanggal_pengajuan' => $request->tanggal_pengajuan,
            'berkas_pendukung' => $request->file('berkas_pendukung')->store('uploads') ?? null,
        ]);

        // Simpan item yang dipinjam ke dalam loan_request_items
        foreach ($request->items as $item) {
            LoanRequestItem::create([
                'loan_request_id' => $loanRequest->id,
                'item_id' => $item['item_id'],
                'quantity' => $item['quantity'],
            ]);
        }

        // Hapus session 'cart' setelah permohonan berhasil dibuat
        session()->forget('cart');

        return redirect()->route('loan.request.success')->with('success', 'Permohonan berhasil dibuat.');
    }


    public function addToCart(Request $request)
    {
        $itemId = $request->input('item_id');
        $itemName = $request->input('item_name');
        $cart = session()->get('cart', []);

        // Jika item sudah ada di keranjang, tambahkan jumlahnya
        if (isset($cart[$itemId])) {
            $cart[$itemId]['quantity']++;
        } else {
            // Jika item belum ada, tambahkan ke keranjang
            $cart[$itemId] = [
                'name' => $itemName,
                'quantity' => 1,
                // Tambahkan data lain yang diperlukan
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Item added to cart!');
    }


    public function removeCart($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return response()->json(['success' => true]);
    }


}
