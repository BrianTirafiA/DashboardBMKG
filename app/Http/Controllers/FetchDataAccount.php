<?php

namespace App\Http\Controllers;  
  
use Illuminate\Http\Request;  
use App\Models\User;  
  
class FetchDataAccount extends Controller  
{  
    public function fetchAccountData(Request $request)  
    {  
        // Ambil data pengguna berdasarkan ID pengguna yang sedang login  
        $user = $request->user(); // Mengambil pengguna yang sedang login  
  
        // Cek apakah semua atribut yang diperlukan ada  
        $isComplete = $user->name && $user->email && $user->fullname && $user->nip && $user->no_telepon && $user->unitkerja_id;  
  
        // Kembalikan data ke view  
        return view('your_view_name', [  
            'user' => $user,  
            'isComplete' => $isComplete,  
        ]);  
    }  
}  
