<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\UnitKerja;
use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserControllerForUpdateData extends Controller
{
    public function index()
    {
        // Mengambil ID pengguna dari sesi  
        $userId = session('id');

        // Mengambil data pengguna berdasarkan ID  
        $user = User::find($userId);

        // Pastikan pengguna ditemukan  
        if (!$user) {
            return redirect()->route('login')->withErrors('User not found.');
        }

        // Mengambil data unit kerja jika diperlukan  
        $unitKerjas = UnitKerja::all(); // Sesuaikan dengan model Anda  

        // Mengirim data ke tampilan  
        return view('profile', compact('user', 'unitKerjas'));
    }

    public function profileindex()
    {
        // Mengambil ID pengguna dari sesi  
        $userId = session('id');

        // Mengambil data pengguna berdasarkan ID  
        $user = User::find($userId);

        // Pastikan pengguna ditemukan  
        if (!$user) {
            return redirect()->route('login')->withErrors('User not found.');
        }

        // Mengambil data unit kerja jika diperlukan  
        $unitKerjas = UnitKerja::all(); // Sesuaikan dengan model Anda  

        // Mengirim data ke tampilan  
        return view('profile', compact('user', 'unitKerjas'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input        
        $request->validate([
            'name' => 'required|string|max:255|unique:users,name,' . $id,
            'email' => 'required|string|email|max:255',
            'fullname' => 'nullable|string|max:255',
            'nip' => 'nullable|string|max:20',
            'no_telepon' => 'nullable|string|max:15',
            'unit_kerja_id' => 'nullable|exists:unitkerjas,id',
        ]);

        // Temukan pengguna berdasarkan ID    
        $user = User::findOrFail($id);

        // Update data pengguna    
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'fullname' => $request->fullname,
            'nip' => $request->nip,
            'no_telepon' => $request->no_telepon,
            'unit_kerja_id' => $request->unit_kerja_id,
        ]);

        // Simpan informasi user dan role dalam sesi    
        $request->session()->put([
            'id' => $user->id, // Use $user instead of $userRecord  
            'user' => $user->name,
            'email' => $user->email,
            'fullname' => $user->fullname,
            'nip' => $user->nip,
            'unit_kerja_id' => $user->unit_kerja_id,
            'no_telepon' => $user->no_telepon,
            'unit_kerja_name' => $user->unit_kerja ? $user->unit_kerja->nama_unit_kerja : null, // Cek apakah unit kerja ada    
        ]);

        // Redirect dengan pesan sukses    
        return redirect('/login')->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function uploadImage(Request $request, $id)  
{  
    $request->validate([  
        'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk gambar        
    ]);  
  
    $user = User::findOrFail($id);  
  
    // Hapus foto profil lama jika ada        
    if ($user->profile_photo && Storage::disk('private')->exists($user->profile_photo)) {  
        Storage::disk('private')->delete($user->profile_photo);  
    }  
  
    // Simpan foto profil baru dengan nama unik        
    $filename = uniqid() . '.' . $request->file('profile_photo')->getClientOriginalExtension();  
    $path = $request->file('profile_photo')->storeAs('profile_photos', $filename, 'private');  
    $user->profile_photo = $path;  
    $user->save();  
  
    // Update session key 'profile_picture'    
    $request->session()->put([    
        'profile_photo' => $user->profile_photo,  
    ]);  
  
    return redirect()->back()->with('success', 'Profile photo updated successfully.');  
}  


    public function deleteImage(Request $request, $id )
    {
        $user = User::findOrFail($id);

        // Hapus foto profil jika ada      
        if ($user->profile_photo) {
            // Cek apakah file ada sebelum menghapus      
            if (Storage::disk('public')->exists($user->profile_photo)) {
                Storage::disk('public')->delete($user->profile_photo);
            }
            // Set kolom profile_photo ke null      
            $user->profile_photo = null;
            $user->save();

             // Update session key 'profile_picture'  
            $request->session()->put([  
            'profile_photo' => $user->profile_photo,
        ]);
        }

        return redirect()->back()->with('success', 'Profile photo deleted successfully.');
    }


}
