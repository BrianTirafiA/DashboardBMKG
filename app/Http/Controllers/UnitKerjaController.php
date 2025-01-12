<?php    
namespace App\Http\Controllers;  
  
use App\Models\UnitKerja;  
use Illuminate\Http\Request;  
use Illuminate\Http\RedirectResponse;  
  
class UnitKerjaController extends Controller  
{  
    // Menampilkan daftar unit kerja untuk admin  
    public function index(Request $request)  
    {  
        $unitkerjas = UnitKerja::paginate(10); // Ambil semua unit kerja dengan pagination  
        return view('lending-asset.admin.unitkerja', compact('unitkerjas'));  
    }  
  
    // Fungsi pencarian  
public function search(Request $request)  
{  
    $query = $request->input('search'); // Ambil input pencarian  
  
    // Jika query kosong, kembalikan semua unit kerja  
    if (empty($query)) {  
        $unitkerjas = UnitKerja::paginate(10);  
    } else {  
        $unitkerjas = UnitKerja::where('nama_unit_kerja', 'ILIKE', "%{$query}%") // Gunakan ILIKE untuk PostgreSQL  
            ->orWhere('alamat', 'ILIKE', "%{$query}%") // Gunakan ILIKE untuk PostgreSQL  
            ->paginate(10);  
    }  
  
    return view('lending-asset.admin.unitkerja', compact('unitkerjas', 'query')); // Kembalikan view dengan data yang difilter  
}  

  
    // Menyimpan unit kerja baru  
    public function store(Request $request)  
    {  
        $request->validate([  
            'nama_unit_kerja' => 'required|string|max:255',  
            'alamat' => 'required|string',  
        ]);  
  
        UnitKerja::create([  
            'nama_unit_kerja' => $request->nama_unit_kerja,  
            'alamat' => $request->alamat,  
        ]);  
  
        return redirect()->back()->with('success', 'Unit kerja berhasil ditambahkan.');  
    }  
  
    // Menampilkan form untuk mengedit unit kerja  
    public function edit($id)  
    {  
        $unitkerja = UnitKerja::findOrFail($id);  
        return response()->json($unitkerja);  
    }  
  
    // Memperbarui unit kerja  
    public function update(Request $request, $id)  
    {  
        $request->validate([  
            'nama_unit_kerja' => 'required|string|max:255',  
            'alamat' => 'required|string',  
        ]);  
  
        $unitkerja = UnitKerja::findOrFail($id);  
        $unitkerja->update([  
            'nama_unit_kerja' => $request->nama_unit_kerja,  
            'alamat' => $request->alamat,  
        ]);  
  
        return redirect()->route('unitkerja.index')->with('success', 'Unit kerja berhasil diperbarui.');  
    }  
  
    // Menghapus unit kerja  
    public function destroy($id): RedirectResponse  
    {  
        $unitkerja = UnitKerja::findOrFail($id);  
        $unitkerja->delete();  
        return redirect()->route('unitkerja.index')->with('success', 'Data Berhasil Dihapus!');  
    }  

      // Menampilkan detail unit kerja (jika diperlukan)  
      public function show($id)  
      {  
          $unitkerja = UnitKerja::findOrFail($id);  
          return view('lending-asset.admin.unitkerja_show', compact('unitkerja'));  
      } 
}  

