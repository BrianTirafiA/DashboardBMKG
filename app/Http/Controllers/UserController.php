<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{

    private UserService $userService;

    public function __construct(UserService $userService){
        $this->userService = $userService;
    }

    public function login(): Response{
        return response()
            ->view("login", [
                "title" => "Login"
            ]);
    }

    public function doLogin(Request $request): Response|RedirectResponse
    {
        $user = $request->input('user');
        $password = $request->input('password');

        if(empty($user) || empty($password)){
            return response()->view("login", [
                "title" => "login",
                "error" => "Both username and password is required"
            ]);
        }

        if($this->userService->login($user, $password)){
            $request->session()->put("user", $user);
            return redirect ("/qcdashboard");
        }

        return response()->view("login", [
            "title" => "Login",
            "error" => "Username or password is incorrect"
        ]);


    }

    // public function doLogOut(Request $request){
    //     $request->session()->forget("user");
    //     return redirect("/login");
    // }

    public function doLogOut(Request $request) {
        $request->session()->forget("user");
        return redirect("/login");
    }
    
}
