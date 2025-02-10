<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UnitKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // Menampilkan form registrasi
    public function showRegisterForm()
    {
        $unitKerjas = UnitKerja::all();
        return view('register', compact('unitKerjas'));
    }

    // Proses registrasi pengguna
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user' => 'required|string|unique:users,name',
            'fullname' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'unitkerja_id' => 'nullable|exists:unitkerjas,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->user,
            'fullname' => $request->fullname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'unit_kerja_id' => $request->unitkerja_id,
            'role' => 'pending',
        ]);

        return redirect('/login')->with('success', 'Akun berhasil dibuat, silakan tunggu konfirmasi.');
    }

    // Menampilkan form login
    public function login()
    {
        return view('login');
    }

    // Proses login
    public function doLogin(Request $request)
    {
        $credentials = $request->validate([
            'user' => 'required|string',
            'password' => 'required|string'
        ]);

        if (!Auth::attempt(['name' => $credentials['user'], 'password' => $credentials['password']])) {
            return back()->withErrors(['login' => 'Username atau password salah.']);
        }

        $user = Auth::user();

        if ($user->role === 'pending') {
            Auth::logout();
            return back()->withErrors(['login' => 'Akun Anda masih dalam proses verifikasi.']);
        }

        // Simpan informasi user di session
        session([
            'id' => $user->id,
            'user' => $user->name,
            'role' => $user->role,
            'email' => $user->email,
            'fullname' => $user->fullname,
            'nip' => $user->nip,
            'unit_kerja_id' => $user->unit_kerja_id,
            'no_telepon' => $user->no_telepon,
            'profile_photo' => $user->profile_photo,
            'unit_kerja_name' => $user->unit_kerja ? $user->unit_kerja->nama_unit_kerja : null,
        ]);

        return redirect($user->role === 'admin' ? '/admin/dashboard' : '/user/dashboard');
    }

    // Proses logout
    public function doLogout(Request $request)
    {
        Auth::logout();
        session()->flush();
        return redirect('/login')->with('success', 'Logout berhasil!');
    }

    // Menampilkan form edit pengguna
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $unitKerjas = UnitKerja::all();
        return view('user.edit', compact('user', 'unitKerjas'));
    }

    // Proses update akun
    public function updateUserLogin(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:users,name,' . $id,
            'email' => 'required|email|max:255',
            'fullname' => 'required|string|max:255',
            'nip' => 'required|string|max:20',
            'no_telepon' => 'required|string|max:255',
            'unit_kerja' => 'required|exists:unitkerjas,id',
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

        session([
            'name' => $request->name,
            'email' => $request->email,
            'fullname' => $request->fullname,
            'nip' => $request->nip,
            'no_telepon' => $request->no_telepon,
            'unit_kerja_name' => UnitKerja::find($request->unit_kerja)->nama_unit_kerja,
        ]);

        return redirect()->back()->with('success', 'Data akun berhasil diperbarui.');
    }
}