<?php  
  
namespace App\Http\Middleware;  
  
use Closure;  
use Illuminate\Http\Request;  
use Symfony\Component\HttpFoundation\Response;  
  
class OnlyGuestMiddleware  
{  
    /**  
     * Handle an incoming request.  
     *  
     * @param  \Illuminate\Http\Request  $request  
     * @param  \Closure  $next  
     * @return \Symfony\Component\HttpFoundation\Response  
     */  
    public function handle(Request $request, Closure $next): Response  
    {  
    // Cek apakah pengguna sudah terautentikasi  
    if (!$request->session()->exists("user")) {  
        return $next($request);  
    } else {  
        // Cek apakah rute yang diminta adalah rute register  
        if ($request->is('register')) {  
            return $next($request); // Izinkan akses ke halaman register  
        }  
  
        // Redirect berdasarkan role  
        $role = $request->session()->get('role');  
        if ($role === 'admin') {  
            return redirect("/admin/qcdashboard");  
        } elseif ($role === 'user') {  
            return redirect("/user/dashboard");  
        } else {  
            return redirect("/login")->with('error', 'Invalid user role');  
        }  
    }  
}  

}  
