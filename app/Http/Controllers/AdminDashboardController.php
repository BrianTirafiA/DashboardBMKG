<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UnitKerja;
use App\Models\ItemDetail;
use App\Models\ItemCategory;
use App\Models\ItemBrand;
use App\Models\ItemLocation;
use App\Models\LoanRequest;
use App\Models\LoanRequestItem;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        // Ambil data statistik
        $data = [
            'totaluser' => User::count(),
            'totalroleuser' => User::where('role', 'user')->count(),
            'totalroleadmin' => User::where('role', 'admin')->count(),
            'totalrolepending' => User::where('role', 'pending')->count(),
            'totalunitkerja' => UnitKerja::count(),
            'totalitem' => ItemDetail::count(),
            'totalborrowed' => ItemDetail::whereDoesntHave('category', function ($query) {
        $query->where('name_category', 'Layanan'); // Filter kategori "Layanan"
    })
    ->whereHas('loanRequestItems.LoanRequest', function ($query) {
        $query->where('approval_status', 'approved'); // Hanya untuk loan_request yang sudah disetujui
    })
    ->sum('borrowed_quantity'),

            'totalservice' => ItemDetail::whereHas('category', function ($query) {
                $query->where('name_category', 'Layanan'); // Filter berdasarkan kategori "Layanan"
            })->sum('borrowed_quantity'),
            'totalcategory' => ItemCategory::count(),
            'totalbrand' => ItemBrand::count(),
            'totallocation' => ItemLocation::count(),
            'totaltransaksi' => LoanRequest::count(),
            'totalpermohonan' => LoanRequest::where('approval_status', 'pending')->count(),
            'totaldiproses' => LoanRequest::where('approval_status', 'onprocess')->count(),
            'totalactiveborrowed' => LoanRequest::where('approval_status', 'approved')->count(),
            'totalrejected' => LoanRequest::where('approval_status', 'rejected')->count(),
        ];

        // Jika request dari API, kembalikan dalam format JSON
        if ($request->wantsJson()) {
            return response()->json($data);
        }

        // Jika request biasa (web), tampilkan ke view
        return view('lending-asset.admin.dashboard', compact('data'));
    }
}
