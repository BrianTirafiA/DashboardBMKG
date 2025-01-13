<?php

namespace App\Http\Controllers;  
  
use App\Models\Pertanyaan;  
use Illuminate\Http\Request;  
  
class PertanyaanController extends Controller  
{  
    public function index()  
    {  
        $pertanyaans = Pertanyaan::all(); // Mengambil semua data pertanyaan  
        return view('lending-asset.user.user-faq', compact('pertanyaans'));  
    }  

    public function adminindex()  
    {  
        $pertanyaans = Pertanyaan::all(); // Mengambil semua data pertanyaan  
        return view('lending-asset.admin.edit-faq', compact('pertanyaans'));  
    }  
  
    // Menampilkan form untuk membuat pertanyaan baru  
    public function create()  
    {  
        return view('admin.faq'); // Mengarahkan ke tampilan FAQ  
    }  
  
    // Menyimpan pertanyaan baru  
    public function store(Request $request)  
    {  
        $request->validate([  
            'question' => 'required|string|max:255',  
            'answer' => 'required|string',  
        ]);  
  
        Pertanyaan::create($request->only('question', 'answer'));  
  
        return redirect()->route('faq.create')->with('success', 'Pertanyaan berhasil ditambahkan.');  
    }  
  
    // Menampilkan form edit  
    public function edit($id)  
    {  
        $pertanyaan = Pertanyaan::findOrFail($id);  
        return response()->json($pertanyaan); // Mengembalikan data dalam format JSON  
    }  
  
    // Memperbarui data  
    public function update(Request $request, $id)  
    {  
        $request->validate([  
            'question' => 'required|string|max:255',  
            'answer' => 'required|string',  
        ]);  
  
        $pertanyaan = Pertanyaan::findOrFail($id);  
        $pertanyaan->update($request->only('question', 'answer'));  
  
        return redirect()->route('faq.create')->with('success', 'Pertanyaan berhasil diperbarui.');  
    }    
}  
