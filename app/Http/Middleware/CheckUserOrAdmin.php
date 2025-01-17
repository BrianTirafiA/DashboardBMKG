<?php  
  
namespace App\Http\Middleware;  
  
use Closure;  
use Illuminate\Http\Request;  
use Illuminate\Support\Facades\Session;  
  
class CheckUserOrAdmin  
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
        // Memeriksa apakah ada role di session  
        $role = Session::get('role');  
  
        // Memeriksa apakah role adalah admin atau user  
        if ($role === 'admin' || $role === 'user') {  
            return $next($request); // Mengizinkan akses  
        }  
  
        // Mengatur pesan kesalahan dalam sesi dan mengarahkan pengguna ke /login  
        Session::flash('error', 'Unauthorized access.');  
        return redirect('/login'); // Arahkan ke halaman login  
    }  
}  
