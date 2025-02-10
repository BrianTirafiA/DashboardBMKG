<?php

namespace App\Http\Controllers;

use App\Models\LoanRequest;
use App\Models\LoanRequestItem;
use App\Models\ItemDetail;
use Illuminate\Http\Request;
use SebastianBergmann\Environment\Console;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailSend;

class LoanRequestController extends Controller
{
    // Menampilkan daftar permohonan peminjaman    
    public function index(Request $request)
    {
        // Mengambil data permohonan dengan relasi item        
        $loan_requests = LoanRequest::with('items.itemDetail', 'user')
            ->where('approval_status', 'pending') // Filter berdasarkan status
            ->whereDoesntHave('items.itemDetail.category', function ($query) {
                $query->where('name_category', 'Layanan'); // Filter berdasarkan kategori "Layanan"
            })       
            ->when($request->search, function ($query) use ($request) {
                $searchTerm = $request->search;

                // Mengubah search term menjadi lowercase    
                $searchTermLower = strtolower($searchTerm);

                // Mencari berdasarkan nama pengguna, alasan peminjaman, dan item      
                $query->whereHas('user', function ($q) use ($searchTermLower) {
                    $q->whereRaw('LOWER(fullname) LIKE ?', ['%' . $searchTermLower . '%']);
                })
                    ->orWhereRaw('LOWER(alasan_peminjaman) LIKE ?', ['%' . $searchTermLower . '%'])
                    ->orWhereHas('items', function ($q) use ($searchTermLower) {
                    $q->whereHas('itemDetail', function ($subQuery) use ($searchTermLower) {
                        $subQuery->whereRaw('LOWER(nama_item) LIKE ?', ['%' . $searchTermLower . '%']);
                    });
                });
            })
            ->paginate(9); // Atur jumlah data per halaman sesuai kebutuhan      

        // Menangani jika tidak ada data yang ditemukan  
        if ($loan_requests->isEmpty()) {
            return view('lending-asset.admin.transaksi-pengajuan', [
                'loan_requests' => $loan_requests,
                'message' => 'Tidak ada permohonan yang ditemukan.' // Pesan untuk ditampilkan di tampilan  
            ]);
        }

        return view('lending-asset.admin.transaksi-pengajuan', compact('loan_requests'));
    }

    public function pengajuanlayananindex(Request $request)
    {
        // Mengambil data permohonan dengan relasi item        
        $loan_requests = LoanRequest::with('items.itemDetail', 'user',)
            ->where('approval_status', 'pending') // Filter berdasarkan status    
            ->whereHas('items.itemDetail.category', function ($query) {
                $query->where('name_category', 'Layanan'); // Filter berdasarkan kategori "Layanan"
            })
            ->when($request->search, function ($query) use ($request) {
                $searchTerm = $request->search;

                // Mengubah search term menjadi lowercase    
                $searchTermLower = strtolower($searchTerm);

                // Mencari berdasarkan nama pengguna, alasan peminjaman, dan item      
                $query->whereHas('user', function ($q) use ($searchTermLower) {
                    $q->whereRaw('LOWER(fullname) LIKE ?', ['%' . $searchTermLower . '%']);
                })
                    ->orWhereRaw('LOWER(alasan_peminjaman) LIKE ?', ['%' . $searchTermLower . '%'])
                    ->orWhereHas('items', function ($q) use ($searchTermLower) {
                    $q->whereHas('itemDetail', function ($subQuery) use ($searchTermLower) {
                        $subQuery->whereRaw('LOWER(nama_item) LIKE ?', ['%' . $searchTermLower . '%']);
                    });
                });
            })
            ->paginate(9); // Atur jumlah data per halaman sesuai kebutuhan      

        // Menangani jika tidak ada data yang ditemukan  
        if ($loan_requests->isEmpty()) {
            return view('lending-asset.admin.transaksi-pengajuan-layanan', [
                'loan_requests' => $loan_requests,
                'message' => 'Tidak ada permohonan yang ditemukan.' // Pesan untuk ditampilkan di tampilan  
            ]);
        }

        return view('lending-asset.admin.transaksi-pengajuan-layanan', compact('loan_requests'));
    }

    // Menampilkan daftar permohonan peminjaman    
    public function pengembalianindex(Request $request)
    {
        // Mengambil data permohonan dengan relasi item        
        $loan_requests = LoanRequest::with('items.itemDetail', 'user')
            ->where('approval_status', 'approved') // Filter berdasarkan status      
            ->whereDoesntHave('items.itemDetail.category', function ($query) {
                $query->where('name_category', 'Layanan'); // Filter berdasarkan kategori "Layanan"
            })    
            ->when($request->search, function ($query) use ($request) {
                $searchTerm = $request->search;

                // Mengubah search term menjadi lowercase    
                $searchTermLower = strtolower($searchTerm);

                // Mencari berdasarkan nama pengguna, alasan peminjaman, dan item      
                $query->whereHas('user', function ($q) use ($searchTermLower) {
                    $q->whereRaw('LOWER(fullname) LIKE ?', ['%' . $searchTermLower . '%']);
                })
                    ->orWhereRaw('LOWER(alasan_peminjaman) LIKE ?', ['%' . $searchTermLower . '%'])
                    ->orWhereHas('items', function ($q) use ($searchTermLower) {
                    $q->whereHas('itemDetail', function ($subQuery) use ($searchTermLower) {
                        $subQuery->whereRaw('LOWER(nama_item) LIKE ?', ['%' . $searchTermLower . '%']);
                    });
                });
            })
            ->paginate(9); // Atur jumlah data per halaman sesuai kebutuhan      

        // Menangani jika tidak ada data yang ditemukan  
        if ($loan_requests->isEmpty()) {
            return view('lending-asset.admin.transaksi-pengembalian', [
                'loan_requests' => $loan_requests,
                'message' => 'Tidak ada permohonan yang ditemukan.' // Pesan untuk ditampilkan di tampilan  
            ]);
        }
        return view('lending-asset.admin.transaksi-pengembalian', compact('loan_requests'));
    }

    // Menampilkan daftar permohonan peminjaman    
    public function rejectedindex(Request $request)
    {
        // Mengambil data permohonan dengan relasi item        
        $loan_requests = LoanRequest::with('items.itemDetail', 'user')
            ->where('approval_status', 'rejected') // Filter berdasarkan status       
            ->when($request->search, function ($query) use ($request) {
                $searchTerm = $request->search;

                // Mengubah search term menjadi lowercase    
                $searchTermLower = strtolower($searchTerm);

                // Mencari berdasarkan nama pengguna, alasan peminjaman, dan item      
                $query->whereHas('user', function ($q) use ($searchTermLower) {
                    $q->whereRaw('LOWER(fullname) LIKE ?', ['%' . $searchTermLower . '%']);
                })
                    ->orWhereRaw('LOWER(alasan_peminjaman) LIKE ?', ['%' . $searchTermLower . '%'])
                    ->orWhereHas('items', function ($q) use ($searchTermLower) {
                    $q->whereHas('itemDetail', function ($subQuery) use ($searchTermLower) {
                        $subQuery->whereRaw('LOWER(nama_item) LIKE ?', ['%' . $searchTermLower . '%']);
                    });
                });
            })
            ->paginate(9); // Atur jumlah data per halaman sesuai kebutuhan      

        // Menangani jika tidak ada data yang ditemukan  
        if ($loan_requests->isEmpty()) {
            return view('lending-asset.admin.transaksi-dibatalkan', [
                'loan_requests' => $loan_requests,
                'message' => 'Tidak ada permohonan yang ditemukan.' // Pesan untuk ditampilkan di tampilan  
            ]);
        }
        return view('lending-asset.admin.transaksi-dibatalkan', compact('loan_requests'));
    }

    public function layananindex(Request $request)
    {
        // Mengambil data permohonan dengan relasi item        
        $loan_requests = LoanRequest::with('items.itemDetail', 'user') 
            ->whereHas('items.itemDetail.category', function ($query) {
                $query->where('name_category', 'Layanan'); // Filter berdasarkan kategori "Layanan"
            })     
            ->when($request->search, function ($query) use ($request) {
                $searchTerm = $request->search;

                // Mengubah search term menjadi lowercase    
                $searchTermLower = strtolower($searchTerm);

                // Mencari berdasarkan nama pengguna, alasan peminjaman, dan item      
                $query->whereHas('user', function ($q) use ($searchTermLower) {
                    $q->whereRaw('LOWER(fullname) LIKE ?', ['%' . $searchTermLower . '%']);
                })
                    ->orWhereRaw('LOWER(alasan_peminjaman) LIKE ?', ['%' . $searchTermLower . '%'])
                    ->orWhereHas('items', function ($q) use ($searchTermLower) {
                    $q->whereHas('itemDetail', function ($subQuery) use ($searchTermLower) {
                        $subQuery->whereRaw('LOWER(nama_item) LIKE ?', ['%' . $searchTermLower . '%']);
                    });
                });
            })
            ->paginate(9); // Atur jumlah data per halaman sesuai kebutuhan      

        // Menangani jika tidak ada data yang ditemukan  
        if ($loan_requests->isEmpty()) {
            return view('lending-asset.admin.transaksi-riwayat-layanan', [
                'loan_requests' => $loan_requests,
                'message' => 'Tidak ada permohonan yang ditemukan.' // Pesan untuk ditampilkan di tampilan  
            ]);
        }
        return view('lending-asset.admin.transaksi-riwayat-layanan', compact('loan_requests'));
    }

    public function peminjamanindex(Request $request)
    {
        // Mengambil data permohonan dengan relasi item        
        $loan_requests = LoanRequest::with('items.itemDetail', 'user')
            ->whereDoesntHave('items.itemDetail.category', function ($query) {
                $query->where('name_category', 'Layanan'); // Filter berdasarkan kategori "Layanan"
            })     
            ->when($request->search, function ($query) use ($request) {
                $searchTerm = $request->search;

                // Mengubah search term menjadi lowercase    
                $searchTermLower = strtolower($searchTerm);

                // Mencari berdasarkan nama pengguna, alasan peminjaman, dan item      
                $query->whereHas('user', function ($q) use ($searchTermLower) {
                    $q->whereRaw('LOWER(fullname) LIKE ?', ['%' . $searchTermLower . '%']);
                })
                    ->orWhereRaw('LOWER(alasan_peminjaman) LIKE ?', ['%' . $searchTermLower . '%'])
                    ->orWhereHas('items', function ($q) use ($searchTermLower) {
                    $q->whereHas('itemDetail', function ($subQuery) use ($searchTermLower) {
                        $subQuery->whereRaw('LOWER(nama_item) LIKE ?', ['%' . $searchTermLower . '%']);
                    });
                });
            })
            ->paginate(9); // Atur jumlah data per halaman sesuai kebutuhan      

        // Menangani jika tidak ada data yang ditemukan  
        if ($loan_requests->isEmpty()) {
            return view('lending-asset.admin.transaksi-riwayat-layanan', [
                'loan_requests' => $loan_requests,
                'message' => 'Tidak ada permohonan yang ditemukan.' // Pesan untuk ditampilkan di tampilan  
            ]);
        }
        return view('lending-asset.admin.transaksi-riwayat-layanan', compact('loan_requests'));
    }

    // Menampilkan daftar permohonan peminjaman    
    public function onprocessindex(Request $request)
    {
        // Mengambil data permohonan dengan relasi item        
        $loan_requests = LoanRequest::with('items.itemDetail', 'user', 'admin')
            ->where('approval_status', 'onprocess') // Filter berdasarkan status       
            ->when($request->search, function ($query) use ($request) {
                $searchTerm = $request->search;

                // Mengubah search term menjadi lowercase    
                $searchTermLower = strtolower($searchTerm);

                // Mencari berdasarkan nama pengguna, alasan peminjaman, dan item      
                $query->whereHas('user', function ($q) use ($searchTermLower) {
                    $q->whereRaw('LOWER(fullname) LIKE ?', ['%' . $searchTermLower . '%']);
                })
                    ->orWhereRaw('LOWER(alasan_peminjaman) LIKE ?', ['%' . $searchTermLower . '%'])
                    ->orWhereHas('items', function ($q) use ($searchTermLower) {
                    $q->whereHas('itemDetail', function ($subQuery) use ($searchTermLower) {
                        $subQuery->whereRaw('LOWER(nama_item) LIKE ?', ['%' . $searchTermLower . '%']);
                    });
                });
            })
            ->paginate(9); // Atur jumlah data per halaman sesuai kebutuhan      

        // Menangani jika tidak ada data yang ditemukan  
        if ($loan_requests->isEmpty()) {
            return view('lending-asset.admin.transaksi-proses', [
                'loan_requests' => $loan_requests,
                'message' => 'Tidak ada permohonan yang ditemukan.' // Pesan untuk ditampilkan di tampilan  
            ]);
        }
        return view('lending-asset.admin.transaksi-proses', compact('loan_requests'));
    }

    // Menampilkan daftar permohonan peminjaman    
    public function reportindex(Request $request)
    {
        // Mengambil data permohonan dengan relasi item        
        $loan_requests = LoanRequest::with('items.itemDetail', 'user')
            ->when($request->search, function ($query) use ($request) {
                $searchTerm = $request->search;

                // Mengubah search term menjadi lowercase    
                $searchTermLower = strtolower($searchTerm);

                // Mencari berdasarkan nama pengguna, alasan peminjaman, dan item      
                $query->whereHas('user', function ($q) use ($searchTermLower) {
                    $q->whereRaw('LOWER(fullname) LIKE ?', ['%' . $searchTermLower . '%']);
                })
                    ->orWhereRaw('LOWER(alasan_peminjaman) LIKE ?', ['%' . $searchTermLower . '%'])
                    ->orWhereHas('items', function ($q) use ($searchTermLower) {
                    $q->whereHas('itemDetail', function ($subQuery) use ($searchTermLower) {
                        $subQuery->whereRaw('LOWER(nama_item) LIKE ?', ['%' . $searchTermLower . '%']);
                    });
                });
            })
            ->paginate(9); // Atur jumlah data per halaman sesuai kebutuhan      

        // Menangani jika tidak ada data yang ditemukan  
        if ($loan_requests->isEmpty()) {
            return view('lending-asset.admin.report', [
                'loan_requests' => $loan_requests,
                'message' => 'Tidak ada permohonan yang ditemukan.' // Pesan untuk ditampilkan di tampilan  
            ]);
        }
        return view('lending-asset.admin.report', compact('loan_requests'));
    }

    // Menyimpan permohonan peminjaman baru  
    public function store(Request $request)
    {
        // Validasi data  
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'durasi_peminjaman' => 'required|integer',
            'alasan_peminjaman' => 'required|string',
            'tanggal_pengajuan' => 'required|date',
            'berkas_pendukung' => 'nullable|file',
            'items' => 'required|array',
            'items.*.item_details_id' => 'required|exists:item_details,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        // Menyimpan permohonan peminjaman  
        $loanRequest = LoanRequest::create([
            'user_id' => $request->user_id,
            'durasi_peminjaman' => $request->durasi_peminjaman,
            'alasan_peminjaman' => $request->alasan_peminjaman,
            'tanggal_pengajuan' => $request->tanggal_pengajuan,
            'berkas_pendukung' => $request->file('berkas_pendukung') ? $request->file('berkas_pendukung')->store('uploads') : null,
            'approval_status' => 'pending',
        ]);

        // Menyimpan item peminjaman  
        foreach ($request->items as $item) {
            LoanRequestItem::create([
                'loan_request_id' => $loanRequest->id,
                'item_details_id' => $item['item_details_id'],
                'quantity' => $item['quantity'],
            ]);
        }

        return redirect()->route('pengajuan.index')->with('success', 'Permohonan peminjaman berhasil ditambahkan.');
    }

    // Mengupdate permohonan peminjaman  
    public function update(Request $request, $id)
    {
        // Validasi input    
        $request->validate([
            'approval_status' => 'nullable|string',
            'admin_id' => 'nullable|exists:users,id',
            'approval_date' => 'nullable|date',
            'confirmation_date' => 'nullable|date',
            'returned_date' => 'nullable|date|string',
            'note' => 'nullable|string',
        ]);

        // Temukan permohonan peminjaman
        $loan_request = LoanRequest::findOrFail($id);

        // Array of fields to update
        $fieldsToUpdate = [];

        // Check each field and add to the update array if present in the request
        if ($request->has('approval_status')) {
            $fieldsToUpdate['approval_status'] = $request->approval_status;
        }
        if ($request->has('admin_id')) {
            $fieldsToUpdate['admin_id'] = $request->admin_id;
        }
        if ($request->has('approval_date')) {
            $fieldsToUpdate['approval_date'] = $request->approval_date;
        }
        if ($request->has('confirmation_date')) {
            $fieldsToUpdate['confirmation_date'] = $request->confirmation_date;
        }
        if ($request->has('returned_date')) {
            $fieldsToUpdate['returned_date'] = $request->returned_date;
        }
        if ($request->has('note')) {
            $fieldsToUpdate['note'] = $request->note;
        }

        // Simpan status persetujuan yang baru
        $loan_request->update($fieldsToUpdate);

        // Kirim email setelah pembaruan
        $this->kirimEmail($loan_request);

        // Jika status diubah menjadi "rejected" atau "returned"
        if (in_array($request->approval_status, ['rejected', 'returned'])) {
            // Ambil semua item yang terkait dengan permohonan ini
            $loan_request_items = LoanRequestItem::where('loan_request_id', $id)->get();

            foreach ($loan_request_items as $item) {
                // Temukan detail item
                $itemDetail = ItemDetail::find($item->item_details_id);
                if ($itemDetail) {
                    // Kurangi borrowed_quantity
                    $itemDetail->borrowed_quantity -= $item->quantity;
                    $itemDetail->save();
                }
            }
        }

        return redirect()->back();
    }

    private function kirimEmail($loan_request)
    {
        $details = [
            'tiket' => $loan_request->id,
            'fullname' => $loan_request->user->fullname, // Pastikan relasi user ada
            'email' => $loan_request->user->email, // Pastikan relasi user ada
            'email_admin' => $loan_request->admin->email, // Pastikan relasi user ada
            'fullname_admin' => $loan_request->admin->fullname, // Pastikan relasi user ada
            'nip_admin' => $loan_request->admin->nip, // Pastikan relasi user ada
            'approval_status' => $loan_request->approval_status,
            'note' => $loan_request->note,
            'templateview' => 'lending-asset.admin.email-print',
        ];

        Mail::to($details['email'])->send(new MailSend($details));

        // Anda bisa menambahkan logika tambahan jika diperlukan
    }

    public function returned(Request $request, $loanRequestId)
    {
        // Validasi input
        $request->validate([
            'approval_status' => 'required|in:approved,rejected,returned',
            'note' => 'nullable|string',
        ]);

        // Mulai transaksi database
        DB::beginTransaction();

        try {
            $loan_request = LoanRequest::findOrFail($loanRequestId);

            // Jika status diubah menjadi 'returned', maka kurangi borrowed_quantity
            if ($request->approval_status === 'returned') {
                foreach ($loan_request->loanRequestItems as $loanItem) {
                    $itemDetail = ItemDetail::lockForUpdate()->find($loanItem->item_details_id);
                    if ($itemDetail) {
                        $itemDetail->borrowed_quantity -= $loanItem->quantity;
                        $itemDetail->save();
                    }
                }
            }

            // Perbarui status peminjaman
            $loan_request->approval_status = $request->approval_status;
            $loan_request->note = $request->note;
            $loan_request->save();

            // Kirim email setelah pembaruan
            $this->kirimEmail($loan_request);

            // Commit transaksi
            DB::commit();

            return redirect()->back()->with('success', 'Status peminjaman berhasil diperbarui.');
        } catch (\Exception $e) {
            // Rollback jika terjadi error
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan, silakan coba lagi.');
        }
    }


    // Menampilkan daftar permohonan peminjaman hanya untuk user yang sedang login
    public function user_pengajuanindex(Request $request)
    {
        // Ambil ID user yang sedang login
        $userId = session('id');

        // Mengambil data permohonan dengan relasi item berdasarkan user yang login
        $loan_requests = LoanRequest::with('items.itemDetail', 'user')
            ->where('approval_status', 'pending') // Filter berdasarkan status pending
            ->where('user_id', $userId) // Filter berdasarkan user yang sedang login
            ->when($request->search, function ($query) use ($request) {
                $searchTerm = $request->search;

                // Mengubah search term menjadi lowercase
                $searchTermLower = strtolower($searchTerm);

                // Mencari berdasarkan nama pengguna, alasan peminjaman, dan item
                $query->whereHas('user', function ($q) use ($searchTermLower) {
                    $q->whereRaw('LOWER(fullname) LIKE ?', ['%' . $searchTermLower . '%']);
                })
                    ->orWhereRaw('LOWER(alasan_peminjaman) LIKE ?', ['%' . $searchTermLower . '%'])
                    ->orWhereHas('items', function ($q) use ($searchTermLower) {
                    $q->whereHas('itemDetail', function ($subQuery) use ($searchTermLower) {
                        $subQuery->whereRaw('LOWER(nama_item) LIKE ?', ['%' . $searchTermLower . '%']);
                    });
                });
            })
            ->paginate(9); // Atur jumlah data per halaman sesuai kebutuhan

        // Menangani jika tidak ada data yang ditemukan
        if ($loan_requests->isEmpty()) {
            return view('lending-asset.user.user-pengajuan', [
                'loan_requests' => $loan_requests,
                'message' => 'Tidak ada permohonan yang ditemukan.' // Pesan untuk ditampilkan di tampilan
            ]);
        }

        return view('lending-asset.user.user-pengajuan', compact('loan_requests'));
    }

    // Menampilkan daftar permohonan peminjaman    
    public function user_prosesindex(Request $request)
    {

        // Ambil ID user yang sedang login
        $userId = session('id');

        // Mengambil data permohonan dengan relasi item        
        $loan_requests = LoanRequest::with('items.itemDetail', 'user', 'admin')
            ->where('approval_status', 'onprocess') // Filter berdasarkan status    
            ->where('user_id', $userId) // Filter berdasarkan user yang sedang login   
            ->when($request->search, function ($query) use ($request) {
                $searchTerm = $request->search;

                // Mengubah search term menjadi lowercase    
                $searchTermLower = strtolower($searchTerm);

                // Mencari berdasarkan nama pengguna, alasan peminjaman, dan item      
                $query->whereHas('user', function ($q) use ($searchTermLower) {
                    $q->whereRaw('LOWER(fullname) LIKE ?', ['%' . $searchTermLower . '%']);
                })
                    ->orWhereRaw('LOWER(alasan_peminjaman) LIKE ?', ['%' . $searchTermLower . '%'])
                    ->orWhereHas('items', function ($q) use ($searchTermLower) {
                    $q->whereHas('itemDetail', function ($subQuery) use ($searchTermLower) {
                        $subQuery->whereRaw('LOWER(nama_item) LIKE ?', ['%' . $searchTermLower . '%']);
                    });
                });
            })
            ->paginate(9); // Atur jumlah data per halaman sesuai kebutuhan      

        // Menangani jika tidak ada data yang ditemukan  
        if ($loan_requests->isEmpty()) {
            return view('lending-asset.user.user-proses', [
                'loan_requests' => $loan_requests,
                'message' => 'Tidak ada permohonan yang ditemukan.' // Pesan untuk ditampilkan di tampilan  
            ]);
        }
        return view('lending-asset.user.user-proses', compact('loan_requests'));
    }

    public function user_pengembalianindex(Request $request)
    {
        // Ambil ID user yang sedang login
        $userId = session('id');

        // Mengambil data permohonan dengan relasi item        
        $loan_requests = LoanRequest::with('items.itemDetail', 'user')
            ->where('approval_status', 'approved') // Filter berdasarkan status    
            ->where('user_id', $userId) // Filter berdasarkan user yang sedang login     
            ->when($request->search, function ($query) use ($request) {
                $searchTerm = $request->search;

                // Mengubah search term menjadi lowercase    
                $searchTermLower = strtolower($searchTerm);

                // Mencari berdasarkan nama pengguna, alasan peminjaman, dan item      
                $query->whereHas('user', function ($q) use ($searchTermLower) {
                    $q->whereRaw('LOWER(fullname) LIKE ?', ['%' . $searchTermLower . '%']);
                })
                    ->orWhereRaw('LOWER(alasan_peminjaman) LIKE ?', ['%' . $searchTermLower . '%'])
                    ->orWhereHas('items', function ($q) use ($searchTermLower) {
                    $q->whereHas('itemDetail', function ($subQuery) use ($searchTermLower) {
                        $subQuery->whereRaw('LOWER(nama_item) LIKE ?', ['%' . $searchTermLower . '%']);
                    });
                });
            })
            ->paginate(9); // Atur jumlah data per halaman sesuai kebutuhan      

        // Menangani jika tidak ada data yang ditemukan  
        if ($loan_requests->isEmpty()) {
            return view('lending-asset.user.user-pengembalian', [
                'loan_requests' => $loan_requests,
                'message' => 'Tidak ada permohonan yang ditemukan.' // Pesan untuk ditampilkan di tampilan  
            ]);
        }
        return view('lending-asset.user.user-pengembalian', compact('loan_requests'));
    }

    public function user_riwayatindex(Request $request)
    {
        // Ambil ID user yang sedang login
        $userId = session('id');

        // Mengambil data permohonan dengan relasi item        
        $loan_requests = LoanRequest::with('items.itemDetail', 'user', 'admin')
            ->where('user_id', $userId) // Filter berdasarkan user yang sedang login    
            ->when($request->search, function ($query) use ($request) {
                $searchTerm = $request->search;

                // Mengubah search term menjadi lowercase    
                $searchTermLower = strtolower($searchTerm);

                // Mencari berdasarkan nama pengguna, alasan peminjaman, dan item      
                $query->whereHas('user', function ($q) use ($searchTermLower) {
                    $q->whereRaw('LOWER(fullname) LIKE ?', ['%' . $searchTermLower . '%']);
                })
                    ->orWhereRaw('LOWER(alasan_peminjaman) LIKE ?', ['%' . $searchTermLower . '%'])
                    ->orWhereHas('items', function ($q) use ($searchTermLower) {
                    $q->whereHas('itemDetail', function ($subQuery) use ($searchTermLower) {
                        $subQuery->whereRaw('LOWER(nama_item) LIKE ?', ['%' . $searchTermLower . '%']);
                    });
                });
            });

        // Memfilter berdasarkan periode
        if ($request->has('periode') && $request->periode != '') {
            $periode = $request->periode;
            $now = now();

            switch ($periode) {
                case 'sepekan':
                    $loan_requests->where('tanggal_pengajuan', '>=', $now->subWeek());
                    break;
                case 'satu_bulan':
                    $loan_requests->where('tanggal_pengajuan', '>=', $now->subMonth());
                    break;
                case 'satu_tahun':
                    $loan_requests->where('tanggal_pengajuan', '>=', $now->subYear());
                    break;
                case 'triwulan':
                    $loan_requests->where('tanggal_pengajuan', '>=', $now->subMonths(3));
                    break;
                case 'semester':
                    $loan_requests->where('tanggal_pengajuan', '>=', $now->subMonths(6));
                    break;
            }
        }

        // Mengambil data dengan pagination
        $loan_requests = $loan_requests->paginate(8);

        // Menangani jika tidak ada data yang ditemukan  
        if ($loan_requests->isEmpty()) {
            return view('lending-asset.user.user-riwayat', [
                'loan_requests' => $loan_requests,
                'message' => 'Tidak ada permohonan yang ditemukan.' // Pesan untuk ditampilkan di tampilan  
            ]);
        }

        return view('lending-asset.user.user-riwayat', compact('loan_requests'));
    }

}
