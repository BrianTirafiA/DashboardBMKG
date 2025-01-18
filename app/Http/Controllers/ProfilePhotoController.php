<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilePhotoController extends Controller
{
    public function show($filename)  
{  
    // Ambil pengguna yang terautentikasi  
    $user = session('id');  
  
    // Periksa apakah pengguna berwenang untuk mengakses gambar ini  
    // Anda bisa menyesuaikan logika ini sesuai kebutuhan  
    if ($user) {  
        // Dapatkan path gambar  
        $path = storage_path('app/private/profile_photos/' . $filename);  
  
        // Periksa apakah file ada  
        if (!file_exists($path)) {  
            abort(404); // File tidak ditemukan  
        }  
  
        // Kembalikan respons gambar  
        return response()->file($path);  
    }  
  
    return abort(403); // Akses ditolak  
}   
}
