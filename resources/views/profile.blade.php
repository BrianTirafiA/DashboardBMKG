<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

@php  
        use App\Models\User;
    // Ambil semua unit kerja dari database    
    $users = User::all();    
@endphp
<x-navbar-user></x-navbar-user>
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div id="table"
        class="relative flex w-1/2 p-8 flex-col text-gray-700 bg-white border border-gray-900 shadow-md rounded-xl">
        <div class="relative m-2 overflow-hidden text-gray-700 bg-white rounded-none">
            <div class="bg-white rounded-lg p-6 w-auto">
                <h3 class="text-lg text-center font-bold mb-4">Edit Data Pengguna</h3>

                <div class="flex flex-row pt-5 rounded-xl justify-center border border-gray-300 space-x-7">
                    <div>
                        <!-- Display current profile photo or default image -->
                        <div class="text-center">
                            <img src="{{ route('profile.photo', basename($user->profile_photo)) }}" alt="Profile Photo"
                                class="w-36 h-36  border border-gray-300 p-2 rounded-2xl mx-auto ">
                        </div>
                    </div>

                    <div class="w-1/3">
                        <!-- Form untuk mengupdate gambar profil -->
                        <form action="{{ route('profile.upload.image', $user->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                                aria-describedby="file_input_help" id="file_input" type="file" name="profile_photo"
                                required>
                            <p class="text-xs text-gray-500" id="file_input_help">SVG, PNG, JPG or GIF (MAX. 800x800px).
                            </p>
                            <button type="submit"
                                class="inline-flex py-2 px-4 mt-2 border border-blue-900 rounded-md shadow-sm text-sm font-medium text-blue-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Update Foto  Profile 
                            </button>
                        </form>
                        <!-- Form untuk menghapus gambar profil -->
                        <form action="{{ route('profile.delete.image', $user->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this image?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="inline-flex py-2 px-6 border border-red-900 rounded-md shadow-sm text-sm font-medium text-red-600 hover:text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                Hapus Foto Profil
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <form id="editForm" action="{{ route('profile.update', $user->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT') 
                <input type="hidden" name="id" id="editUserId" value="{{ $user->id }}">

                <div class="flex flex-row w-auto space-x-10 justify-center">
                    <div class="w-full">
                        <div class="mb-4">
                            <label for="editUsername"
                                class="block text-sm font-medium text-gray-700 mb-2">Username</label>
                            <input type="text" name="name" id="editUsername"
                                class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-md outline-blue-600"
                                placeholder="Tambahkan Username (unique)" value="{{ session('user') }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="editEmail" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" name="email" id="editEmail"
                                class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-md outline-blue-600"
                                placeholder="Tambahkan Email" value="{{ session('email') }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="editNamaLengkap" class="block text-sm font-medium text-gray-700 mb-2">Nama
                                Lengkap</label>
                            <input type="text" name="fullname" id="editNamaLengkap"
                                class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-md outline-blue-600"
                                placeholder="Tambahkan Nama Lengkap" value="{{ session('fullname')}}">
                        </div>
                    </div>

                    <div class="w-full">
                        <div class="mb-4">
                            <label for="editNIP" class="block text-sm font-medium text-gray-700 mb-2">NIP</label>
                            <input type="text" name="nip" id="editNIP"
                                class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-md outline-blue-600"
                                placeholder="Tambahkan Nomor Induk Pegawai" value="{{ session('nip') }}">
                        </div>
                        <div class="mb-4">
                            <label for="editTelepon" class="block text-sm font-medium text-gray-700 mb-2">Nomor
                                Telepon</label>
                            <input type="number" name="no_telepon" id="editTelepon"
                                class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-md outline-blue-600"
                                placeholder="Tambahkan Nomor Telepon" value="{{ session('no_telepon')}}">
                        </div>
                        <div class="mb-4">
                            <label for="editUnitKerja" class="block text-sm font-medium text-gray-700 mb-2">Unit
                                Kerja</label>
                            <select name="unit_kerja_id" id="editUnitKerja"
                                class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-md outline-blue-600">
                                <option value="">Pilih Unit Kerja</option>
                                @foreach($unitKerjas as $unitKerja)                
                                    <option value="{{ $unitKerja->id }}" {{ $unitKerja->id == $user->unit_kerja_id ? 'selected' : '' }}>{{ $unitKerja->nama_unit_kerja }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="flex justify-center mt-2">
                    <button type="submit"
                        class="inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Update Data Account
                    </button>
                    <button type="button"
                        class="ml-2 inline-flex justify-center py-2 px-4 border rounded-md shadow-sm text-sm font-medium text-gray-500 hover:bg-gray-200 border-indigo-600"
                        onclick="window.location='{{ route('login') }}'">
                        Kembali
                    </button>

                </div>
            </form>
        </div>
    </div>
</div>