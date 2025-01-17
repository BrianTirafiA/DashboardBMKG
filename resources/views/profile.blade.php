<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Login Page</title>  
    <script src="https://cdn.tailwindcss.com"></script>  
</head>  
  
<div>  
    <x-navbar-user></x-navbar-user>  
  
    <div id="table" class="relative flex w-1/2 flex-col text-gray-700 bg-white border border-gray-900 shadow-md rounded-xl mt-1 me-5">    
        <div class="relative m-2 overflow-hidden text-gray-700 bg-white rounded-none">    
  
            <div class="bg-white rounded-lg p-6 w-auto">    
                <h3 class="text-lg text-center font-bold mb-4">Edit Data Pengguna</h3>    
  
                <div class="mb-4">    
                    <label for="editProfilePicture" class="block text-sm text-center font-medium text-gray-700 mb-2">Photo Profile</label>    
                    <div class="flex items-center justify-center w-full">    
                        <label for="profile-photo" class="flex flex-col items-center justify-center w-32 h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">    
                            <div class="flex flex-col items-center justify-center">    
                                <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">    
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />    
                                </svg>    
                                <p class="-mt-3 mb-2 text-xs text-center text-gray-500 dark:text-gray-400">    
                                    <span class="font-semibold">Click to upload</span> <br> or drag and drop    
                                </p>    
                                <p class="text-xs text-gray-500 text-center dark:text-gray-400">SVG, PNG, or JPG <br> (MAX. 800x800px)</p>    
                            </div>    
                            <input id="profile-photo" name="photo-profile" type="file" class="hidden" />    
                        </label>    
                    </div>    
                </div>    
  
                <form id="editForm" action="{{ route('profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">    
                    @csrf    
                    @method('PUT')     
                    <input type="hidden" name="id" id="editUserId" value="{{ $user->id }}">    
  
                    <div class="flex flex-row w-auto space-x-10 justify-center">    
                        <div class="w-full">    
                            <div class="mb-4">    
                                <label for="editUsername" class="block text-sm font-medium text-gray-700 mb-2">Username</label>    
                                <input type="text" name="name" id="editUsername" class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-md outline-blue-600" placeholder="Tambahkan Username (unique)" value="{{ session('user') }}" required>    
                            </div>    
                            <div class="mb-4">    
                                <label for="editEmail" class="block text-sm font-medium text-gray-700 mb-2">Email</label>    
                                <input type="email" name="email" id="editEmail" class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-md outline-blue-600" placeholder="Tambahkan Email" value="{{ session('email') }}" required>    
                            </div>    
                            <div class="mb-4">    
                                <label for="editNamaLengkap" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>    
                                <input type="text" name="fullname" id="editNamaLengkap" class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-md outline-blue-600" placeholder="Tambahkan Nama Lengkap" value="{{ session('fullname')}}">    
                            </div>    
                        </div>    
  
                        <div class="w-full">    
                            <div class="mb-4">    
                                <label for="editNIP" class="block text-sm font-medium text-gray-700 mb-2">NIP</label>    
                                <input type="text" name="nip" id="editNIP" class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-md outline-blue-600" placeholder="Tambahkan Nomor Induk Pegawai" value="{{ session('nip') }}">    
                            </div>    
                            <div class="mb-4">    
                                <label for="editTelepon" class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>    
                                <input type="number" name="no_telepon" id="editTelepon" class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-md outline-blue-600" placeholder="Tambahkan Nomor Telepon" value="{{ session('no_telepon')}}">    
                            </div>    
                            <div class="mb-4">    
                                <label for="editUnitKerja" class="block text-sm font-medium text-gray-700 mb-2">Unit Kerja</label>    
                                <select name="unit_kerja_id" id="editUnitKerja" class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-md outline-blue-600">    
                                    <option value="">Pilih Unit Kerja</option>    
                                    @foreach($unitKerjas as $unitKerja)              
                                        <option value="{{ $unitKerja->id }}" {{ $unitKerja->id == $user->unit_kerja_id ? 'selected' : '' }}>{{ $unitKerja->nama_unit_kerja }}</option>    
                                    @endforeach    
                                </select>    
                            </div>    
                        </div>    
                    </div>    
  
                    <div class="flex justify-center mt-2">    
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">    
                            Update Data    
                        </button>    
                        <button type="button" id="closeEditModal" class="ml-2 inline-flex justify-center py-2 px-4 border rounded-md shadow-sm text-sm font-medium text-gray-500 hover:bg-gray-200 border-indigo-600" onclick="window.history.back();">    
                            Batalkan Edit    
                        </button>    
                    </div>    
                </form>    
            </div>    
        </div>    
    </div>    
  
</div>    
