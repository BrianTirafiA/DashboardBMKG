<?php

namespace App\Http\Controllers;

use App\Models\Rack;
use App\Models\RackType;
use App\Models\RackAttribute;
use App\Models\RackAttributeValue;
use App\Models\RackStatuses;
use App\Models\Device;
use App\Models\Panel;
use Illuminate\Http\Request;

class RackController extends Controller
{
    public function index()
    {
        $racks = Rack::with('attributes.attribute')->get();
        return view('racks.index', compact('racks'));
    }

    public function create()
    {
        $rackTypes = RackType::all();
        return view('itAsset.rack-controller', compact('rackTypes'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'rack_type_id' => 'required|exists:rack_types,id',
        ]);

        // Buat Rak Baru
        $rack = Rack::create([
            'name' => $validated['name'],
            'rack_type_id' => $validated['rack_type_id'],
        ]);

        // Ambil semua atribut yang terkait dengan rack_type_id
        $attributes = RackAttribute::where('rack_type_id', $rack->rack_type_id)->get();

        // Jumlah baris default adalah 43
        $rowCount = 43;

        // Iterasi untuk setiap atribut dan buat baris RackAttributeValue
        foreach ($attributes as $attribute) {
            for ($i = 0; $i < $rowCount; $i++) {
                // Membuat nilai default untuk setiap baris per atribut
                RackAttributeValue::create([
                    'rack_id' => $rack->id,
                    'attribute_id' => $attribute->id,
                    'row_index' => $i,  // Baris yang unik berdasarkan index
                    'value' => null,     // Nilai defaultnya adalah null
                ]);
            }
        }

        // Redirect kembali dengan pesan sukses
        return redirect('/admin/itasset/dashboard')->with('success', 'Perubahan berhasil disimpan!');
    }

    public function show($id)
    {
        $rack = Rack::with(['rackType', 'rackType.attributes', 'values'])->findOrFail($id);

        // Mengelompokkan values berdasarkan attribute_id
        $values = $rack->values->groupBy('attribute_id');
        $devices = Device::all();
        $statuses = RackStatuses::all();
        $pdus = Panel::with('rakPanel')->get();


        return view('itAsset.rack-attributes', compact('rack', 'values', 'devices', 'statuses', 'pdus'));
    }



    public function updateValues(Request $request, $id)
    {
        $rack = Rack::findOrFail($id);
        $values = $request->input('rack', []);

        foreach ($values as $rackId => $attributes) {
            foreach ($attributes as $attributeId => $rows) {
                foreach ($rows as $rowIndex => $value) {
                    RackAttributeValue::updateOrCreate(
                        [
                            'rack_id' => $rackId,
                            'attribute_id' => $attributeId,
                            'row_index' => $rowIndex
                        ],
                        [
                            'value' => $value
                        ]
                    );
                }
            }
        }

        return redirect()->back()->with('success', 'Perubahan berhasil disimpan!');
    }


    public function destroy($id)
    {
        $rack = Rack::find($id);

        if (!$rack) {
            return response()->json(['message' => 'Rak tidak ditemukan'], 404);
        }

        try {
            $rack->delete();
            return redirect('/admin/itasset/dashboard')->with('success', 'Perubahan berhasil disimpan!');

        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal menghapus rak', 'error' => $e->getMessage()], 500);
        }
    }

    public function syncRackWithPDU(Request $request)
    {
        $validated = $request->validate([
            'rack_id' => 'required|integer',
            'attributes' => 'required|array',
        ]);

        $rackId = $validated['rack_id'];
        $attributes = $validated['attributes']; // Array berisi row_index & pdu

        foreach ($attributes as $rowIndex => $pduValue) {
            if (!empty($pduValue)) {
                // Cari panel yang memiliki PDU yang sesuai
                $panel = Panel::whereJsonContains('pdu', $pduValue)->first();

                if ($panel) {
                    // Data yang akan ditambahkan ke JSON 'rak'
                    $newRakData = [
                        'rack_id' => $rackId,
                        'row_index' => $rowIndex,
                    ];

                    // Ambil data sebelumnya
                    $currentRakData = $panel->rak ?? [];

                    // Cek apakah sudah ada entry yang sama, jika belum, tambahkan
                    if (!in_array($newRakData, $currentRakData)) {
                        $currentRakData[] = $newRakData;
                        $panel->rak = $currentRakData;
                        $panel->save();
                    }
                }
            }
        }

        return redirect()->back()->with('success', 'PDU berhasil diperbarui!');
    }


}
