<?php

namespace App\Http\Controllers;

use App\Models\Panel;
use App\Models\RackAttributeValue;
use App\Models\Rack;

use Illuminate\Http\Request;

class PanelController extends Controller
{
    public function index()
    {
        $this->updatePanelData();

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

    public function updatePanelData()
    {
        // Ambil semua panel
        $panels = Panel::all();

        foreach ($panels as $panel) {
            // Inisialisasi array kosong untuk menyimpan semua rak yang cocok
            $racksData = [];

            // Ambil semua RackAttributeValue dengan attribute_id = 12
            $rackAttributes = RackAttributeValue::where('attribute_id', 12)->get();

            foreach ($rackAttributes as $rackAttribute) {
                // Pecah value menjadi array jika ada koma (misal: "5A,6B")
                $values = explode(',', $rackAttribute->value);

                foreach ($values as $value) {
                    $value = trim($value); // Hilangkan spasi berlebih

                    // Cek apakah value ini cocok dengan pdu di panel
                    if ($value === $panel->pdu) {
                        // Ambil nama rack dari tabel racks berdasarkan rack_id
                        $rack = Rack::find($rackAttribute->rack_id);
                        $rackName = $rack ? $rack->name : 'Unknown Rack';

                        // Tambahkan ke array dalam format yang diinginkan (row_index + 1)
                        $racksData[] = ($rackAttribute->row_index + 1) . " ({$rackName})";
                    }
                }
            }

            // Jika ada data yang cocok, simpan ke dalam kolom rak dengan format multiline
            if (!empty($racksData)) {
                $panel->rak = implode("\n", $racksData);
                $panel->save();
            }
        }

        return redirect()->back()->with('success', 'Data panel telah diperbarui.');
    }







}
