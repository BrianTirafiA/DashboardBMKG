<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Lokasi - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    
    <style>
        #map {
            height: 500px;
            z-index: 1;
            /* Pastikan z-index lebih rendah dari modal */
            position: relative;
            /* Pastikan posisi relatif untuk z-index berfungsi */
        }

        .reset-button {  
            background-color: #fff;  
            border: 1px solid #ccc;  
            padding: 5px 10px;  
            cursor: pointer;  
        }
    </style>
</head>

@if(isset($error))
    <div id="error-alert"
        class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 bg-red-500 text-white px-4 py-3 mt-6 rounded-lg shadow-lg transition-opacity duration-400 opacity-100">
        <span>{{ $error }}</span>
    </div>

    <script>
        setTimeout(() => {
            const alert = document.getElementById('error-alert');
            if (alert) {
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 300); // Remove after fade-out
            }
        }, 3000);
    </script>
@endif

<x-lend-layout-template>
    <div>
        <div class="me-7 mt-1">
            @php              
                $title = 'Daftar Lokasi Terdaftar';
                $description = 'Halaman ini berisi daftar lokasi yang terdaftar yang dapat Anda kelola.';
                $add = 'Tambah Lokasi Baru';
                $columns = [
                    ['key' => 'id', 'title' => 'ID'],
                    ['key' => 'nama_lokasi', 'title' => 'Nama'],
                    ['key' => 'alamat_lokasi', 'title' => 'Alamat'],
                    ['key' => 'penanggung_jawab', 'title' => 'Penanggung Jawab'],
                    ['key' => 'latitude', 'title' => 'Latitude'],
                    ['key' => 'longitude', 'title' => 'Longitude']
                ];              
            @endphp              

            <div id="table"
                class="relative flex flex-col w-full h-full min-h-[54rem] text-gray-700 bg-white border border-gray-900 shadow-md rounded-xl mb-2">
                <div class="relative mx-4 mt-4 overflow-hidden text-gray-700 bg-white rounded-none">
                    <div class="flex items-center justify-between gap-8 mb-4 ms-5 mt-2">
                        <div>
                            <h5
                                class="block font-sans text-xl font-semibold leading-snug tracking-normal text-blue-gray-900">
                                {{ $title }}
                            </h5>
                            <p class="block mt-1 font-sans text-base font-normal leading-relaxed text-gray-700">
                                {{ $description }}
                            </p>
                        </div>

                        <div class="flex flex-col gap-2 shrink-0 me-5 sm:flex-row">
                            <div class="w-full md:w-72">
                                <form action="{{ route('location.index') }}" method="GET"
                                    class="relative h-10 w-full min-w-[200px] bg-white">
                                    <input id="searchInput" name="search"
                                        class="peer h-full w-full rounded-[7px] border border-blue-gray-200 bg-transparent px-3 py-2.5 text-sm text-blue-gray-700 outline-none transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 focus:border-2 focus:border-gray-900"
                                        placeholder="Search" value="{{ request('search') }}" />
                                    <button type="submit" class="absolute right-3 top-2.5 text-blue-gray-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z">
                                            </path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                            <button type="button" onclick="openAddModal()"
                                class="flex items-center gap-3 rounded-lg bg-gray-900 py-2 px-4 text-xs font-bold uppercase text-white shadow-md transition-all hover:shadow-lg">
                                <p>{{ $add }}</p>
                            </button>
                        </div>
                    </div>

                    <div class="ms-5 me-5 flex p-6 px-0 -mt-5 overflow-hidden">
                        <div class="w-full rounded-xl overflow-hidden border border-blue-gray-100">
                            <table id="usertable" class="w-full mt-4 text-left table-auto">
                                <thead>
                                    <tr>
                                        <th
                                            class="p-4 border-y border-blue-gray-100 bg-blue-gray-50 text-sm font-normal text-blue-gray-900 text-center">
                                            #
                                        </th>
                                        @foreach ($columns as $column)                                     <th
                                                class="p-4 border-y border-blue-gray-100 bg-blue-gray-50 text-sm font-normal text-blue-gray-900 whitespace-normal break-words max-w-[150px]">
                                                {{ $column['title'] }}
                                            </th>
                                        @endforeach
                                        <th
                                            class="p-4 border-y border-blue-gray-100 bg-blue-gray-50 text-sm font-normal text-blue-gray-900 text-center">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($item_locations as $itemlocation)                               <tr>
                                            <td
                                                class="p-4 border-b border-blue-gray-100 text-sm text-blue-gray-900 text-center">
                                                {{ $item_locations->firstItem() + $loop->index }}
                                            </td>
                                            @foreach ($columns as $column)                              <td
                                                    class="p-4 border-b border-blue-gray-100 text-sm text-blue-gray-900 whitespace-normal break-words max-w-[150px]">
                                                    {{ $itemlocation->{$column['key']} }}
                                                </td>
                                            @endforeach
                                            <td class="border-b border-blue-gray-100">
                                                <div class="flex items-center gap-3 justify-center">
                                                    {{-- Tombol Edit --}}
                                                    <button type="button" class="text-blue-500 flex items-center gap-2"
                                                        onclick="openEditModal('{{ $itemlocation->id }}', '{{ $itemlocation->nama_lokasi }}', '{{ $itemlocation->alamat_lokasi }}', '{{ $itemlocation->penanggung_jawab }}', '{{ $itemlocation->latitude }}', '{{ $itemlocation->longitude }}')">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            fill="currentColor" class="bi bi-pencil-square"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                            <path fill-rule="evenodd"
                                                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                                        </svg>
                                                        Edit
                                                    </button>

                                                    {{-- Tombol Hapus --}}
                                                    <form action="{{ route('lokasi.destroy', $itemlocation->id) }}" method="POST" class="inline">  
                                                        @csrf  
                                                        @method('DELETE')  
                                                        <button type="button" class="text-red-500 flex items-center gap-1 delete-button" data-id="{{ $itemlocation->id }}" data-nama_lokasi="{{ $itemlocation->nama_lokasi }}" onclick="showDeleteConfirmation(this)">  
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">  
                                                                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />  
                                                            </svg>  
                                                            Hapus  
                                                        </button>  
                                                    </form>  

                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="{{ count($columns) + 2 }}"
                                                class="p-4 text-center text-sm text-blue-gray-900">Data pengguna belum tersedia.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div id="paginasi" class="flex items-center justify-between p-4 mt-1 border-t border-blue-gray-50">
                        <p class="block font-sans text-sm font-normal leading-normal text-blue-gray-900">
                            Total Data: {{ $item_locations->total() }} | Page {{ $item_locations->currentPage() }} of
                            {{ $item_locations->lastPage() }}
                        </p>
                        <div class="flex gap-2 me-2">
                            @if($item_locations->onFirstPage())
                                <span
                                    class="select-none rounded-lg border border-gray-900 py-2 px-4 text-center font-sans text-xs font-bold uppercase text-gray-900 transition-all opacity-50 cursor-not-allowed">
                                    Previous
                                </span>
                            @else
                                <a href="{{ $item_locations->previousPageUrl() . (request('search') ? '&search=' . urlencode(request('search')) : '') }}"
                                    class="select-none rounded-lg border border-gray-900 py-2 px-4 text-center font-sans text-xs font-bold uppercase text-gray-900 transition-all hover:opacity-75">
                                    Previous
                                </a>
                            @endif
                            @if($item_locations->hasMorePages())
                                <a href="{{ $item_locations->nextPageUrl() . (request('search') ? '&search=' . urlencode(request('search')) : '') }}"
                                    class="select-none rounded-lg border border-gray-900 py-2 px-4 text-center font-sans text-xs font-bold uppercase text-gray-900 transition-all hover:opacity-75">
                                    Next
                                </a>
                            @else
                                <span
                                    class="select-none rounded-lg border border-gray-900 py-2 px-4 text-center font-sans text-xs font-bold uppercase text-gray-900 transition-all opacity-50 cursor-not-allowed">
                                    Next
                                </span>
                            @endif
                        </div>
                    </div>

                    <div id="paginasi" class="flex items-center justify-between p-4 border-t border-blue-gray-50">

                        <div id="map"
                            class="w-full flex items-center rounded-xl mb-10 mt-0 m-3 justify-between p-10 border-t border-blue-gray-50">
                        </div>

                    </div>
                </div>

                <!-- Modal untuk Tambah Pengguna -->
                <div id="addModal"
                    class="fixed inset-0 z-50 hidden bg-gray-800 bg-opacity-50 flex items-center justify-center">
                    <div class="bg-white rounded-lg p-6 w-1/3">
                        <h3 class="text-lg font-bold mb-4">Tambah Pengguna Baru</h3>
                        <form id="addForm" action="{{ route('lokasi.store') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="addNamaLokasi" class="block text-sm font-medium text-gray-700 mb-2">Nama
                                    Lokasi</label>
                                <input type="text" name="nama_lokasi" id="addNamaLokasi"
                                    class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-md outline-blue-600"
                                    placeholder="Tambahkan Nama Lokasi Baru" required>
                            </div>
                            <div class="mb-4">
                                <label for="addAlamatLokasi" class="block text-sm font-medium text-gray-700 mb-2">Alamat
                                    Lokasi</label>
                                <input type="text" name="alamat_lokasi" id="addAlamatLokasi"
                                    class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-md outline-blue-600"
                                    placeholder="Tambahkan Alamat Lokasi Baru" required>
                            </div>
                            <div class="mb-4">
                                <label for="addPenanggungJawab"
                                    class="block text-sm font-medium text-gray-700 mb-2">Penanggung Jawab</label>
                                <input type="text" name="penanggung_jawab" id="addPenanggungJawab"
                                    class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-md outline-blue-600"
                                    placeholder="Tambahkan Penanggung Jawab Lokasi Baru" required>
                            </div>
                            <div class="mb-4">
                                <label for="addLatitude"
                                    class="block text-sm font-medium text-gray-700 mb-2">Latitude</label>
                                <input type="number" name="latitude" id="addLatitude"
                                    class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-md outline-blue-600"
                                    placeholder="Tambahkan Latitude Lokasi Baru" required step="0.000001" min="-90"
                                    max="90">
                            </div>
                            <div class="mb-4">
                                <label for="addLongitude"
                                    class="block text-sm font-medium text-gray-700 mb-2">Longitude</label>
                                <input type="number" name="longitude" id="addLongitude"
                                    class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-md outline-blue-600"
                                    placeholder="Tambahkan Longitude Lokasi Baru" required step="0.000001" min="-180"
                                    max="180">
                            </div>

                            <div class="flex justify-end">
                                <button type="submit"
                                    class="inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Simpan Pengguna
                                </button>
                                <button type="button" id="closeAddModal"
                                    class="ml-2 inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-gray-500 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                    Batal
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Modal untuk Edit Pengguna -->
                <div id="editModal"
                    class="fixed inset-0 z-50 hidden bg-gray-800 bg-opacity-50 flex items-center justify-center">
                    <div class="bg-white rounded-lg p-6 w-1/3">
                        <h3 class="text-lg font-bold mb-4">Edit Pengguna</h3>
                        <form id="editForm" action="{{ route('lokasi.update', '') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')                             
                            
                            <input type="hidden" name="id" id="editLokasiId"> <!-- Input tersembunyi untuk ID -->

                            <div class="mb-4">
                                <label for="editNamaLokasi" class="block text-sm font-medium text-gray-700 mb-2">Nama
                                    Lokasi</label>
                                <input type="text" name="nama_lokasi" id="editNamaLokasi"
                                    class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-md outline-blue-600"
                                    placeholder="Tambahkan Nama Lokasi Baru" required>
                            </div>
                            <div class="mb-4">
                                <label for="editAlamatLokasi"
                                    class="block text-sm font-medium text-gray-700 mb-2">Alamat Lokasi</label>
                                <input type="text" name="alamat_lokasi" id="editAlamatLokasi"
                                    class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-md outline-blue-600"
                                    placeholder="Tambahkan Alamat Lokasi Baru" required>
                            </div>
                            <div class="mb-4">
                                <label for="editPenanggungJawab"
                                    class="block text-sm font-medium text-gray-700 mb-2">Penanggung Jawab</label>
                                <input type="text" name="penanggung_jawab" id="editPenanggungJawab"
                                    class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-md outline-blue-600"
                                    placeholder="Tambahkan Penanggung Jawab Lokasi Baru" required>
                            </div>
                            <div class="mb-4">
                                <label for="editLatitude"
                                    class="block text-sm font-medium text-gray-700 mb-2">Latitude</label>
                                <input type="number" name="latitude" id="editLatitude"
                                    class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-md outline-blue-600"
                                    placeholder="Tambahkan Latitude Lokasi Baru" required step="0.000001" min="-90"
                                    max="90">
                            </div>
                            <div class="mb-4">
                                <label for="editLongitude"
                                    class="block text-sm font-medium text-gray-700 mb-2">Longitude</label>
                                <input type="number" name="longitude" id="editLongitude"
                                    class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-md outline-blue-600"
                                    placeholder="Tambahkan Longitude Lokasi Baru" required step="0.000001" min="-180"
                                    max="180">
                            </div>

                            <div class="flex justify-end">
                                <button type="submit"
                                    class="inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Update Pengguna
                                </button>
                                <button type="button" id="closeEditModal"
                                    class="ml-2 inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-gray-500 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                    Batal
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Modal Konfirmasi Penghapusan -->
                <div id="delete-confirmation-modal"
                    class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50 border border-blue-gray-100 shadow-md rounded-xl">
                    <div class="bg-white rounded-lg shadow-lg p-6 w-1/3">
                        <h2 class="text-lg font-semibold mb-4">Konfirmasi Penghapusan</h2>
                        <p>Apakah Anda yakin ingin daftar lokasi ini?</p>
                        <p id="deleteItemName" class="font-bold"></p>
                        <div class="mt-4 flex justify-end">
                            <button id="cancel-delete"
                                class="mr-2 px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">Batal</button>
                            <button id="confirm-delete"
                                class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Hapus</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        // Koordinat dan zoom awal  
        const initialCenter = [-6.200000, 106.816666];
        const initialZoom = 11;


        // Inisialisasi peta  
        var map = L.map('map' , { attributionControl: false }).setView(initialCenter, initialZoom, ); // Set view awal    

        // Tambahkan layer peta  
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
        }).addTo(map);

        // Menambahkan marker dari item_locations  
        @foreach ($item_locations as $itemlocation)
            L.marker([{{ $itemlocation->latitude }}, {{ $itemlocation->longitude }}])
                .addTo(map)
                .bindPopup("{{ $itemlocation->nama_lokasi }}");
        @endforeach

        // Reset view button  
        const resetButton = L.control({ position: 'topright' });
        resetButton.onAdd = () => {
            const button = L.DomUtil.create('button', 'reset-button');
            button.innerHTML = 'Reset View';
            button.onclick = () => {
                map.setView(initialCenter, initialZoom); // Reset ke view awal  
            };
            return button;
        };
        resetButton.addTo(map);  
    </script>


    <script>
        // Menampilkan modal untuk menambah pengguna                
        function openAddModal() {
            document.getElementById('addForm').reset(); // Reset form                
            document.getElementById('addModal').classList.remove('hidden'); // Tampilkan modal                
        }

        // Menutup modal untuk menambah pengguna                
        document.getElementById('closeAddModal').addEventListener('click', () => {
            document.getElementById('addModal').classList.add('hidden');
        });

        // Menampilkan modal untuk mengedit pertanyaan              
        function openEditModal(id, nama_lokasi, alamat_lokasi, penanggung_jawab, latitude, longitude) {
            document.getElementById('editLokasiId').value = id; // Set ID pengguna  
            document.getElementById('editNamaLokasi').value = nama_lokasi; // Set value Username  
            document.getElementById('editAlamatLokasi').value = alamat_lokasi; // Set value Email  
            document.getElementById('editPenanggungJawab').value = penanggung_jawab; // Set value Nama Lengkap 
            document.getElementById('editLatitude').value = latitude; // Set value password   
            document.getElementById('editLongitude').value = longitude; // Set value NIP  

            // Set action form edit  
            document.getElementById('editForm').action = "{{ route('lokasi.update', '') }}/" + id; // Set action form edit  

            // Tampilkan modal  
            document.getElementById('editModal').classList.remove('hidden');
        }

        // Menutup modal edit              
        document.getElementById('closeEditModal').addEventListener('click', () => {
            document.getElementById('editModal').classList.add('hidden');
        });


        let currentDeleteForm = null; // To store the current delete form      
  
        // Function to show the delete confirmation modal      
        function showDeleteConfirmation(button) {  
            const userId = button.dataset.id; // Get user ID      
            const namaLokasi = button.dataset.nama_lokasi; // Get user name      
            document.getElementById('deleteItemName').textContent = namaLokasi; // Set user name in modal      
            currentDeleteForm = button.closest('form'); // Get the closest form      
            document.getElementById('delete-confirmation-modal').classList.remove('hidden'); // Show modal      
        }  
        
        // Event listener for cancel button      
        document.getElementById('cancel-delete').addEventListener('click', function () {  
            document.getElementById('delete-confirmation-modal').classList.add('hidden'); // Hide modal      
        });  
        
        // Event listener for confirm delete button      
        document.getElementById('confirm-delete').addEventListener('click', function () {  
            if (currentDeleteForm) {  
                currentDeleteForm.submit(); // Submit the form to delete the user      
            }  
            document.getElementById('delete-confirmation-modal').classList.add('hidden'); // Hide modal      
        });  


        // Fungsi untuk memfilter tabel berdasarkan input pencarian              
        function filterTable() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const rows = document.querySelectorAll('#usertable tr');
            rows.forEach(row => {
                const questionCell = row.cells[1].textContent.toLowerCase();
                const answerCell = row.cells[2].textContent.toLowerCase();
                if (questionCell.includes(searchTerm) || answerCell.includes(searchTerm)) {
                    row.style.display = ''; // Tampilkan baris jika cocok              
                } else {
                    row.style.display = 'none'; // Sembunyikan baris jika tidak cocok              
                }
            });
        }

        // Inisialisasi tampilan awal              
        updateRowCount();   
    </script>
</x-lend-layout-template>