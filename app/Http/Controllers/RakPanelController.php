<?php

namespace App\Http\Controllers;

use App\Models\RakPanel;
use App\Models\Panel;
use Illuminate\Http\Request;

class RakPanelController extends Controller
{
    /**
     * Menampilkan daftar rak panel beserta panel yang terhubung.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Mengambil semua rak panel, mengurutkan rak berdasarkan nama, dan panel berdasarkan PDU
        $rakPanels = RakPanel::with([
            'panels' => function ($query) {
                // Pisahkan angka dan huruf pada PDU dan urutkan berdasarkan angka terlebih dahulu
                $query->orderByRaw('CAST(REGEXP_REPLACE(pdu, \'[^0-9]\', \'\', \'g\') AS INTEGER)') // Urutkan berdasarkan angka
                    ->orderByRaw('REGEXP_REPLACE(pdu, \'[0-9]\', \'\', \'g\')'); // Urutkan berdasarkan huruf
            }
        ])->orderBy('name')->get(); // Urutkan rak panel berdasarkan nama

        return view('itAsset.power', compact('rakPanels'));
    }


    /**
     * Menambahkan rak panel baru dengan panel terkait.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Buat Rak Panel baru
        $rakPanel = RakPanel::create([
            'name' => $request->name,
        ]);

        // Generate 16 Panel untuk Rak Panel yang baru dibuat
        for ($i = 1; $i <= 16; $i++) {
            Panel::create([
                'pdu' => $i . $rakPanel->name, // Format PDU (1A, 2A, dst.)
                'rak_panel_id' => $rakPanel->id, // Hubungkan ke Rak Panel
                'kapasitas' => null, // Default kosong
            ]);
        }

        return redirect()->back()->with('success', 'Rak berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        // Cari rak panel berdasarkan ID
        $rakPanel = RakPanel::findOrFail($id);

        // Hapus semua panel yang terkait dengan rak panel ini
        $rakPanel->panels()->delete();

        // Hapus rak panel
        $rakPanel->delete();

        return redirect()->back()->with('success', 'Rak dan panel terkait berhasil dihapus.');
    }

    public function destroy_panel($id)
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

    public function addPanel(Request $request, $rakPanelId)
    {
        // Validasi input
        $request->validate([
            'kapasitas' => 'nullable|integer|min:0', // Jika ingin menambahkan kapasitas default
        ]);

        // Cari Rak Panel berdasarkan ID
        $rakPanel = RakPanel::findOrFail($rakPanelId);

        // Ambil panel terakhir berdasarkan PDU untuk rak panel ini
        $lastPanel = $rakPanel->panels()
            ->orderByRaw('CAST(REGEXP_REPLACE(pdu, \'[^0-9]\', \'\', \'g\') AS INTEGER) DESC') // Urutkan berdasarkan angka terbesar
            ->orderByRaw('REGEXP_REPLACE(pdu, \'[0-9]\', \'\', \'g\') DESC') // Urutkan berdasarkan huruf terbesar
            ->first();

        if ($lastPanel) {
            // Pecah PDU terakhir menjadi angka dan huruf
            preg_match('/(\d+)([A-Z]?)/', $lastPanel->pdu, matches: $matches);
            $lastNumber = $matches[1] ?? 0; // Angka terakhir
            $lastLetter = $matches[2] ?? ''; // Huruf terakhir
        } else {
            // Jika tidak ada panel sebelumnya
            $lastNumber = 0;
            $lastLetter = '';
        }

        // Tambahkan panel baru
        $newPanel = Panel::create([
            'pdu' => ($lastNumber + 1) . $lastLetter, // Lanjutkan angka, huruf tetap
            'rak_panel_id' => $rakPanel->id,
            'kapasitas' => $request->kapasitas ?? null, // Kapasitas default jika tidak diisi
        ]);

        return redirect()->back()->with('success', 'Panel baru berhasil ditambahkan dengan PDU ' . $newPanel->pdu . '.');
    }
}
