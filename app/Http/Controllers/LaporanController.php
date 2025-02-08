<?php

namespace App\Http\Controllers;

use App\Models\LoanRequest;
use App\Models\LoanRequestItem;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF as PDF; // Pastikan ini ada

class LaporanController extends Controller
{
    public function reportindex(Request $request)
{
    // Mengambil data permohonan dengan relasi item        
    $loan_requests = LoanRequest::with('items.itemDetail', 'user', 'admin')
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
    $loan_requests = $loan_requests->paginate(9);

    // Menangani jika tidak ada data yang ditemukan  
    if ($loan_requests->isEmpty()) {
        return view('lending-asset.admin.report', [
            'loan_requests' => $loan_requests,
            'message' => 'Tidak ada permohonan yang ditemukan.' // Pesan untuk ditampilkan di tampilan  
        ]);
    }

    return view('lending-asset.admin.report', compact('loan_requests'));
}

public function cetak(Request $request)
{
    $loan_requests = LoanRequest::with('items.itemDetail', 'user', 'admin');

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

    if ($request->has('search') && $request->search != '') {
        $searchTerm = strtolower($request->search);

        $loan_requests->where(function ($query) use ($searchTerm) {
            $query->whereHas('user', function ($q) use ($searchTerm) {
                $q->whereRaw('LOWER(fullname) LIKE ?', ['%' . $searchTerm . '%']);
            })
            ->orWhereRaw('LOWER(alasan_peminjaman) LIKE ?', ['%' . $searchTerm . '%'])
            ->orWhereHas('items', function ($q) use ($searchTerm) {
                $q->whereHas('itemDetail', function ($subQuery) use ($searchTerm) {
                    $subQuery->whereRaw('LOWER(nama_item) LIKE ?', ['%' . $searchTerm . '%']);
                });
            });
        });
    }

    $loan_requests = $loan_requests->get();

    // Menentukan total halaman
    $total_pages = ceil($loan_requests->count() / 10);
    $page = 1;

    $pdf = PDF::loadView('lending-asset.admin.report-print', compact('loan_requests', 'request', 'total_pages', 'page'));

    return $pdf->download('laporan.pdf');
}



}
