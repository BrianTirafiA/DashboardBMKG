<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Redirectresponse;

class HomeController extends Controller
{
    public function home(Request $request): Redirectresponse{
        if($request->session()->exists("user")){
            return redirect("/home");
        } else {
            return redirect("/login");
        }
    }
}
