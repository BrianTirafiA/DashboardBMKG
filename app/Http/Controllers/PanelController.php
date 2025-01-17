<?php

namespace App\Http\Controllers;

use App\Models\Panel;
use Illuminate\Http\Request;

class PanelController extends Controller
{
    public function index()
    {
        // Mengambil semua data dari tabel panels
        $panels = Panel::all();

        // Mengirimkan data panels ke view
        return view('panel.index', compact('panels'));
    }
}
