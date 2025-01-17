<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;  
use Illuminate\Support\Facades\Hash;  
use App\Models\UnitKerja;


class UserController extends Controller
{
    private UserService $userService;

    public function showRegisterForm()  
    {  
        return view('register');  
    }  
  
    public function register(Request $request)  
    {  
        $unitKerjas = UnitKerja::all();  

        // Validasi input  
        $validator = Validator::make($request->all(), [  
            'user' => 'required|string|unique:users,name',  
            'fullname' => 'required|string',  
            'email' => 'required|email',  
            'password' => 'required|string|min:8|confirmed',
            'unitkerja_id' => 'nullable|exists:unitkerjas,id',
        ]);  
  
        // Jika validasi gagal, kembalikan ke halaman sebelumnya dengan error  
        if ($validator->fails()) {  
            return redirect()->back()->withErrors($validator)->withInput();  
        }  
  
        // Buat pengguna baru  
        User::create([  
            'name' => $request->user,  
            'fullname' => $request->fullname,
            'email' => $request->email,  
            'password' => Hash::make($request->password), 
            'unit_kerja_id' => $request->unitkerja_id,  // Hash password sebelum menyimpannya  
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
    
        if (empty($user) || empty($password)) {    
            return response()->view("login", [    
                "title" => "Login",    
                "error" => "Both username and password are required"    
            ]);    
        }    
    
        $userRecord = User::where('name', $user)->first();    
    
        if (!$userRecord) {    
            return response()->view("login", [    
                "title" => "Login",    
                "error" => "Username or password is incorrect"    
            ]);    
        }    
    
        // Cek apakah password benar    
        if (!$this->userService->login($user, $password)) {    
            return response()->view("login", [    
                "title" => "Login",    
                "error" => "Username or password is incorrect"    
            ]);    
        }    
    
        // Cek apakah role pengguna adalah 'pending'    
        if ($userRecord->role === 'pending') {    
            return response()->view("login", [    
                "title" => "Login",    
                "error" => "Akun Anda masih dalam proses verifikasi. Silakan tunggu hingga akun Anda diaktifkan. Hubungi pusatdatabase@bmkg.go.id"    
            ]);    
        }    
    
        // Simpan informasi user dan role dalam sesi  
        $request->session()->put([  
            'id'=> $userRecord->id,
            'user' => $userRecord->name,  
            'role' => $userRecord->role,  
            'email' => $userRecord->email,  
            'fullname' => $userRecord->fullname,  
            'nip' => $userRecord->nip,  
            'unit_kerja_id' => $userRecord->unit_kerja_id,  
            'no_telepon' => $userRecord->no_telepon,  
            'unit_kerja_name' => $userRecord->unit_kerja ? $userRecord->unit_kerja->nama_unit_kerja : null, // Cek apakah unit kerja ada  
        ]);  
    
        // Redirect berdasarkan role    
        if ($userRecord->role === 'admin') {    
            return redirect("/admin/dashboard");    
        } elseif ($userRecord->role === 'user') {    
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

      // Menampilkan form edit pengguna  
    public function edit($id)  
    {  
        $user = User::findOrFail($id);  
        $unitKerjas = UnitKerja::all(); // Ambil semua unit kerja  
        return view('user.edit', compact('user', 'unitKerjas'));  
    }  

    public function updateuserlogin(Request $request, $id)    
    {    
        $unitKerjas = UnitKerja::all(); // Ambil semua unit kerja  

        // Validasi input    
        $request->validate([    
            'name' => 'required|string|max:255|unique:users,name,' . $id,  // Pastikan name unik  
            'email' => 'required|email|max:255',  // Email tidak perlu unik jika tidak diinginkan  
            'fullname' => 'required|string|max:255',    
            'nip' => 'required|string|max:20',    
            'no_telepon' => 'required|string|max:255',  
            'unit_kerja' => 'required|exists:unitkerjas,id', // Pastikan unit kerja valid  
        ]);    
        
        $user = User::findOrFail($id);      
        $user->update([    
            'name' => $request->name,    
            'email' => $request->email,    
            'fullname' => $request->fullname,      
            'nip' => $request->nip,    
            'no_telepon' => $request->no_telepon,   
            'unit_kerja_id' => $request->unit_kerja,     
        ]);    
        
        // Ambil nama unit kerja dari database  
        $unitKerja = UnitKerja::find($request->unit_kerja);  
        
        // Update session    
        session([    
            'name' => $request->name,    
            'email' => $request->email,    
            'fullname' => $request->fullname,      
            'nip' => $request->nip,    
            'no_telepon' => $request->no_telepon,   
            'unit_kerja_name' => $unitKerja ? $unitKerja->nama_unit_kerja : null, // Ambil nama unit kerja  
        ]);    
        
        return redirect()->back()->with('success', 'Data akun berhasil diperbarui.');    
    }  
}
