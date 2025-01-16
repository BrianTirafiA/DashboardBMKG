<?php  
  
namespace App\Http\Controllers;  
  
use App\Models\User;  
use App\Models\UnitKerja;  
use Illuminate\Http\Request;  
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;  
  
class UserControllerForAdmin extends Controller  
{  
    public function index(Request $request)    
    {    
        $search = $request->input('search');    
        $users = User::with('unit_kerja')    
            ->when($search, function ($query, $search) {    
                return $query->where('name', 'like', "%{$search}%")    
                    ->orWhere('email', 'like', "%{$search}%")    
                    ->orWhere('nip', 'like', "%{$search}%")    
                    ->orWhere('no_telepon', 'like', "%{$search}%");    
            })    
            ->paginate(10);    
    
            // Ambil semua unit kerja dari database  
            $unitKerjas = UnitKerja::all();    
    
        return view('lending-asset.admin.user', compact('users', 'unitKerjas'));    
    }  

    public function store(Request $request)  
    {  
        // Validasi input  
        $request->validate([  
            'name' => 'required|string|max:255|unique:users,name',  
            'email' => 'required|string|email|max:255',  
            'fullname' => 'nullable|string|max:255',  
            'password' => 'required|string|min:8',  
            'nip' => 'nullable|string|max:20',  
            'no_telepon' => 'nullable|string|max:15',  
            'unitkerja_id' => 'nullable|exists:unitkerjas,id', 
            'role' => 'required|string|in:admin,user,pending',  
        ]);  
  
        // Buat pengguna baru  
        User::create([  
            'name' => $request->name,  
            'email' => $request->email,  
            'fullname' => $request->fullname,  
            'password' => Hash::make($request->password),
            'nip' => $request->nip,  
            'no_telepon' => $request->no_telepon,  
            'unit_kerja_id' => $request->unitkerja_id,  
            'role' => $request->role,  
        ]);  
  
        return redirect()->back()->with('success', 'Pengguna berhasil ditambahkan.');  
    }   

    public function edit($id)    
    {    
        $user = UnitKerja::findOrFail($id);    
        return response()->json($user);    
    }  
  
    public function update(Request $request, $id)    
    {    
    // Validasi input    
    $request->validate([    
        'name' => 'required|string|max:255|unique:users,name,'. $id,     
        'email' => 'required|string|email|max:255',    
        'fullname' => 'nullable|string|max:255',    
        'password' => 'nullable|string|min:8',    
        'nip' => 'nullable|string|max:20',    
        'no_telepon' => 'nullable|string|max:15',    
        'unit_kerja_id' => 'nullable|exists:unitkerjas,id',    
        'role' => 'required|string',    
    ]);    
  
    $user = User::findOrFail($id);    
    $user->update([    
        'name' => $request->name,    
        'email' => $request->email,    
        'fullname' => $request->fullname,   
        'nip' => $request->nip,   
        'no_telepon' => $request->no_telepon,   
        'unit_kerja_id' => $request->unit_kerja_id,   
        'role' => $request->role,   
    ]);  
    // Hanya hash password jika diisi  
    if ($request->filled('password')) {    
        $user->password = Hash::make($request->password); // Hash password jika diisi    
    }  
  
    return redirect()->route('users.index')->with('success', 'Pengguna berhasil diperbarui.');    
    }  

    public function destroy(User $user)  
    {  
        $user->delete();  
        return redirect()->back()->with('success', 'Pengguna berhasil dihapus.');  
    }  

    public function show($id)  
    {  
        $user = User::findOrFail($id);  
        return response()->json($user);  
    }  

    public function updateuserlogin(Request $request, $id)  
    {  
        // Validasi input  
        $request->validate([  
            'name' => 'required|string|max:255',  
            'email' => 'required|email|max:255',  
            'fullname' => 'required|string|max:255',  
            'nip' => 'required|string|max:20',  
            'no_telepon' => 'required|string|max:255',
            'unit_kerja' => 'required|string|max:255',  
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
    
        // Update session  
        session([  
            'name' => $request->name,  
            'email' => $request->email,  
            'fullname' => $request->fullname,    
            'nip' => $request->nip,  
            'no_telepon' => $request->no_telepon, 
            'unit_kerja_id' => $request->unit_kerja,   
        ]);  
    
        return redirect()->back()->with('success', 'Data akun berhasil diperbarui.');  
    }  
 
}  
