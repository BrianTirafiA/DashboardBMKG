<?php
namespace App\Http\Controllers;

use App\Models\Rack;
use App\Models\RackType;
use App\Models\Attribute;
use App\Models\RackAttributeValue;
use Illuminate\Http\Request;

class RackController extends Controller
{
    // Menampilkan daftar rak
    public function index()
    {
        $racks = Rack::with('attributes.attribute')->get();
        return view('racks.index', compact('racks'));
    }

    // Membuat rak baru
    public function store(Request $request)
    {
        $rack = Rack::create($request->only(['name', 'type']));

        // Tambahkan nilai atribut
        foreach ($request->attributes as $attributeId => $value) {
            RackAttributeValue::create([
                'rack_id' => $rack->id,
                'attribute_id' => $attributeId,
                'value' => $value,
            ]);
        }

        return redirect()->back()->with('success', 'Rak berhasil ditambahkan!');
    }

    // Menampilkan form untuk membuat rak
    public function create()
    {
        $rackTypes = RackType::with('attributes')->get();
        return view('racks.create', compact('rackTypes'));
    }
}
