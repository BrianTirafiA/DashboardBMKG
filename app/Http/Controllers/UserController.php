<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;  
use Illuminate\Support\Facades\Hash;  


class UserController extends Controller
{
    private UserService $userService;

    public function showRegisterForm()  
    {  
        return view('register');  
    }  
  
    public function register(Request $request)  
    {  
        // Validasi input  
        $validator = Validator::make($request->all(), [  
            'user' => 'required|string|unique:users,name',  
            'email' => 'required|email|unique:users,email',  
            'password' => 'required|string|min:8|confirmed', // Menggunakan 'confirmed' untuk validasi konfirmasi password  
        ]);  
  
        // Jika validasi gagal, kembalikan ke halaman sebelumnya dengan error  
        if ($validator->fails()) {  
            return redirect()->back()->withErrors($validator)->withInput();  
        }  
  
        // Buat pengguna baru  
        User::create([  
            'name' => $request->user,  
            'email' => $request->email,  
            'password' => Hash::make($request->password), // Hash password sebelum menyimpannya  
            'role' => 'pending', // Set role menjadi "pending"  
        ]);  
  
        // Kembalikan respons ke halaman login dengan pesan sukses  
        return redirect('/login')->with('success', 'Akun berhasil dibuat, silakan tunggu konfirmasi.');  
    }  
  
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
    public function doLogOut(Request $request): Response|RedirectResponse
    {
        return redirect('/login')->with('success', 'Logout berhasil!');
    }

    

}
