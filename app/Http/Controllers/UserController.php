<?php

namespace App\Http\Controllers;

use App\Models\User; // Pastikan untuk mengimpor model User
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
                "title" => "Login",
                "error" => "Both username and password are required"
            ]);
        }

        $userRecord = User::where('name', $user)->first();

        if(!$userRecord || !$this->userService->login($user, $password)){
            return response()->view("login", [
                "title" => "Login",
                "error" => "Username or password is incorrect"
            ]);
        }

        // Simpan informasi user dan role dalam sesi
        $request->session()->put("user", $userRecord->name);
        $request->session()->put("role", $userRecord->role);

        // Redirect berdasarkan role
        if($userRecord->role === 'admin'){
            return redirect("/admin/qcdashboard");
        } elseif($userRecord->role === 'user'){
            return redirect("/user/dashboard");
        } else {
            // Optional: Handle role lain atau tampilkan error
            return redirect("/login")->with('error', 'Invalid user role');
        }
    }

    /**
     * Proses Logout.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function doLogOut(Request $request)
    {
        return redirect('/login')->with('success', 'Logout berhasil!');
    }
}
