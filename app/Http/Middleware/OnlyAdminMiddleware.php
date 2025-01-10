<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OnlyAdminMiddleware
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
        if($request->session()->exists("user") && $request->session()->get("role") === 'admin'){
            return $next($request);
        } else {
            return redirect("/register")->with('error', 'Unauthorized access');
        }
    }
}
