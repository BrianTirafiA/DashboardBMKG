<?php
namespace App\Http\Controllers;  
  
use App\Models\Pertanyaan;  
use Illuminate\Http\Request;  
use Illuminate\Http\RedirectResponse;
  
class PertanyaanController extends Controller  
{  

    public function adminindex()  
    {  
        $pertanyaans = Pertanyaan::paginate(8);  

        return view('lending-asset.admin.edit-faq', compact('pertanyaans'));  
    }  
    
    // Menampilkan daftar pertanyaan  
    public function index()  
    {  
        $pertanyaans = Pertanyaan::all();  
        return view('lending-asset.user.user-faq', compact('pertanyaans'));  
    }  

    
  
    // Menyimpan pertanyaan baru  
    public function store(Request $request)  
    {  
        $request->validate([  
            'question' => 'required|string|max:255',  
            'answer' => 'required|string',  
        ]);  
  
        Pertanyaan::create([  
            'question' => $request->question,  
            'answer' => $request->answer,  
        ]);  
  
        return redirect()->back()->with('success', 'Pertanyaan berhasil ditambahkan.');  
    }  
  
    // Menampilkan form untuk mengedit pertanyaan  
    public function edit($id)  
    {  
        $faq = Pertanyaan::findOrFail($id);  
        return response()->json($faq);  
    }  
  
    // Memperbarui pertanyaan  
    public function update(Request $request, $id) {  
        $request->validate([  
            'question' => 'required|string|max:255',  
            'answer' => 'required|string',  
        ]);  
 
        $faq = Pertanyaan::findOrFail($id);  
        $faq->update([  
            'question' => $request->question,  
            'answer' => $request->answer,  
        ]);  
 
        return redirect()->route('faq.index')->with('success', 'Pertanyaan berhasil diperbarui.');  
    }  
    
    // Menghapus pertanyaan  
    public function destroy($id): RedirectResponse  
    {  
        // Ambil pertanyaan berdasarkan ID  
        $faq = Pertanyaan::findOrFail($id);  
    
        // Hapus pertanyaan  
        $faq->delete();  
    
        // Redirect ke halaman index dengan pesan sukses  
        return redirect()->route('faq.index')->with(['success' => 'Data Berhasil Dihapus!']);  
    }  
 
}  
