<?php

namespace App\Http\Controllers;

use App\Models\LoanRequest;
use App\Models\LoanRequestItem;
use Illuminate\Http\Request;
use SebastianBergmann\Environment\Console;

class LoanRequestController extends Controller
{
    // Menampilkan daftar permohonan peminjaman    
    public function index(Request $request)
    {
        // Mengambil data permohonan dengan relasi item        
        $loan_requests = LoanRequest::with('items.itemDetail', 'user')
            ->where('approval_status', 'pending') // Filter berdasarkan status       
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
            ->paginate(10); // Atur jumlah data per halaman sesuai kebutuhan      

        // Menangani jika tidak ada data yang ditemukan  
        if ($loan_requests->isEmpty()) {
            return view('lending-asset.admin.transaksi-pengajuan', [
                'loan_requests' => $loan_requests,
                'message' => 'Tidak ada permohonan yang ditemukan.' // Pesan untuk ditampilkan di tampilan  
            ]);
        }

        return view('lending-asset.admin.transaksi-pengajuan', compact('loan_requests'));
    }


    // Menampilkan daftar permohonan peminjaman    
    public function pengembalianindex(Request $request)
    {
        // Mengambil data permohonan dengan relasi item        
        $loan_requests = LoanRequest::with('items.itemDetail', 'user')
            ->where('approval_status', 'approved') // Filter berdasarkan status       
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
            ->paginate(10); // Atur jumlah data per halaman sesuai kebutuhan      

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
            ->paginate(10); // Atur jumlah data per halaman sesuai kebutuhan      

        // Menangani jika tidak ada data yang ditemukan  
        if ($loan_requests->isEmpty()) {
            return view('lending-asset.admin.transaksi-dibatalkan', [
                'loan_requests' => $loan_requests,
                'message' => 'Tidak ada permohonan yang ditemukan.' // Pesan untuk ditampilkan di tampilan  
            ]);
        }
        return view('lending-asset.admin.transaksi-dibatalkan', compact('loan_requests'));
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
            ->paginate(10); // Atur jumlah data per halaman sesuai kebutuhan      

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
            'admin_id' => 'nullable|exists:users,id', // Pastikan admin_id valid    
            'approval_date' => 'nullable|date',
            'returned_date' => 'date|string',
        ]);
        $loan_requests = LoanRequest::findOrFail($id);
        $loan_requests->update([
            'approval_status' => $request->approval_status,
            'admin_id' => $request->admin_id,
            'approval_date' => $request->approval_date,
            'returned_date' => $request->returned_date,
        ]);

        // Redirect kembali dengan pesan sukses    
        return redirect()->back()->with('success', 'Data permohonan berhasil diperbarui.');
    }

}
