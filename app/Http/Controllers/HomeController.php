<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class HomeController extends Controller
{
    public function home(Request $request): RedirectResponse
    {
        // Cek apakah pengguna sudah login
        if (Auth::check()) {
            $role = Auth::user()->role; // Ambil role dari user yang sedang login

            // Redirect berdasarkan role pengguna
            if ($role === 'admin') {
                return redirect("/admin/dashboard");
            } elseif ($role === 'user') {
                return redirect("/user/dashboard");
            } elseif ($role === 'awsuser') {
                return redirect("/awsqcuser/dashboard");
            }
        }

        // Jika belum login, arahkan ke halaman login
        return redirect("/login");
    }
}
