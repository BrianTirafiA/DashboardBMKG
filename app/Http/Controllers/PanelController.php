<?php

namespace App\Http\Controllers;

use App\Models\Panel;
use Illuminate\Http\Request;

class PanelController extends Controller
{
    public function index()
    {
        $panels = Panel::with('rakPanel')->get(); // Ambil semua panel beserta rak
        return view('itAsset.power', compact('panels'));
    }
    public function destroy($id)
    {
        try {
            // Cari panel berdasarkan ID
            $panel = Panel::findOrFail($id);

            // Hapus panel
            $panel->delete();

            // Redirect kembali dengan pesan sukses
            return redirect()->back()->with('success', 'Panek berhasil dihapus.');
        } catch (\Exception $e) {
            // Redirect kembali dengan pesan error jika terjadi kesalahan
            return redirect()->back()->with('success', 'Panek berhasil dihapus.');
        }
    }
}
