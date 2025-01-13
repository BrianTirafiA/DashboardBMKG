<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Menghapus session pengguna
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Mengarahkan pengguna ke halaman login setelah logout
        return redirect('/login');
    }
}