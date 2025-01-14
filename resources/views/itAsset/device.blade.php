<x-layout-server>
    <!-- <div class="flex flex-wrap items-center gap-4 sm:justify-between justify-center">
        <h2 class="text-2xl font-semibold text-center sm:text-left">
            Daftar Perangkat Ruang Server
        </h2>
        <button class="bg-blue-500 text-white font-medium py-2 px-4 rounded-lg hover:bg-blue-600">
            Tambah
        </button>
    </div> -->

    <!-- <p>Ini adalah konten utama halaman. Anda dapat menambahkan lebih banyak informasi di sini.</p> -->
    <!-- Tabel Device -->
    <div class="me-7 mt-1">
        @php
            $title = 'Daftar Perangkat Ruang Server';
            $description = 'Halaman ini berisi daftar perangkat ruang server yang dapat Anda kelola.';
            $add = 'Tambah Perangkat';
            $columns = [
                ['key' => 'name_device', 'title' => 'Nama'],
                ['key' => 'brand_device', 'title' => 'Merek'],
                ['key' => 'type_device', 'title' => 'Jenis'],
                ['key' => 'year_device', 'title' => 'Tahun'],
                ['key' => 'os_device', 'title' => 'OS'],
                ['key' => 'processor_device', 'title' => 'Processor'],
                ['key' => 'ram_device', 'title' => 'RAM'],
                ['key' => 'disk_device', 'title' => 'Disk'],
            ];
        @endphp

        <div id="table"
            class="relative flex flex-col w-full h-full text-gray-700 bg-white border border-blue-gray-100 shadow-md rounded-xl mb-2">
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
                        <form action="{{ route('device.index') }}" method="GET"
                            class="relative h-10 w-full min-w-[200px] bg-white">
                            <input id="searchInput" name="search"
                                class="peer h-full w-full rounded-[7px] border border-blue-gray-200 bg-transparent px-3 py-2.5 text-sm text-blue-gray-700 outline-none transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 focus:border-2 focus:border-gray-900"
                                placeholder="Cari perangkat" value="{{ request(key: 'search') }}" />
                            <button type="submit" class="absolute right-3 top-2.5 text-blue-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z">
                                    </path>
                                </svg>
                            </button>
                        </form>
                        <button type="button" onclick="openAddModal()"
                            class="flex items-center gap-3 rounded-lg bg-gray-900 py-2 px-4 text-xs font-bold uppercase text-white shadow-md transition-all hover:shadow-lg">
                            <p>{{ $add }}</p>
                        </button>
                    </div>
                </div>

                <div class="ms-5 me-5 flex p-6 px-0 -mt-5 overflow-hidden">
                    <div class="w-full rounded-xl overflow-hidden border border-blue-gray-100">
                        <table id="deviceTable" class="w-full mt-4 text-left table-auto">
                            <thead>
                                <tr>
                                    <th
                                        class="p-4 border-y border-blue-gray-100 bg-blue-gray-50 text-sm font-normal text-blue-gray-900 text-center">
                                        #
                                    </th>
                                    @foreach ($columns as $column)
                                        <th
                                            class="p-4 border-y border-blue-gray-100 bg-blue-gray-50 text-sm font-normal text-blue-gray-900 whitespace-normal break-words max-w-[150px]">
                                            {{ $column['title'] }}
                                        </th>
                                    @endforeach
                                    <th
                                        class="p-4 border-y border-blue-gray-100 bg-blue-gray-50 text-sm font-normal text-blue-gray-900 text-center">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($devices as $device)
                                    <tr>
                                        <td
                                            class="p-4 border-b border-blue-gray-100 text-sm text-blue-gray-900 text-center">
                                            {{ $loop->iteration }}
                                        </td>
                                        @foreach ($columns as $column)
                                            <td
                                                class="p-4 border-b border-blue-gray-100 text-sm text-blue-gray-900 whitespace-normal break-words max-w-[150px]">
                                                {{ $device->{$column['key']} ?? '-' }}
                                            </td>
                                        @endforeach
                                        <td class="border-b border-blue-gray-100">
                                            <div class="flex items-center gap-3 justify-center">
                                                <button type="button" class="text-blue-500 flex items-center gap-2"
                                                    onclick="openEditModal('{{ $device->id }}')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                        <path
                                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                        <path fill-rule="evenodd"
                                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                                    </svg>
                                                </button>
                                                <form action="{{ route('device.destroy', $device->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="text-red-500 flex items-center gap-1 delete-button"
                                                        onclick="confirmDelete('{{ $device->id }}')">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                            <path
                                                                d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="{{ count($columns) + 2 }}"
                                            class="p-4 text-center text-sm text-blue-gray-900">
                                            Data perangkat belum tersedia.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- div id="pagination" class="flex items-center justify-between p-4 border-t border-blue-gray-50">
                <p class="block font-sans text-sm font-normal leading-normal text-blue-gray-900">
                    Total Data: {{ $devices->total() }} | Halaman {{ $devices->currentPage() }} dari
                    {{ $devices->lastPage() }}
                </p>
                <div class="flex gap-2">
                    {{ $devices->links() }}
                </div>
            </div> --}}
        </div>
    </div>
    </div>

    <x-form-add-device />

    <script>
        function openAddModal() {
            document.getElementById('addForm').reset(); // Reset form                
            document.getElementById('addModal').classList.remove('hidden'); // Tampilkan modal                
        }

        document.getElementById('closeAddModal').addEventListener('click', () => {
            document.getElementById('addModal').classList.add('hidden');
        });

        document.getElementById('addForm').addEventListener('submit', function (event) {
            let isValid = true;

            // Validasi input RAM
            let ramInput = document.getElementById('addRAM');
            let ramError = document.getElementById('ramError');
            if (isNaN(ramInput.value) || ramInput.value.trim() === '') {
                isValid = false;
                if (!ramError) {
                    let errorMsg = document.createElement('p');
                    errorMsg.id = 'ramError';
                    errorMsg.classList.add('text-red-500', 'text-sm');
                    errorMsg.textContent = 'RAM harus berupa angka.';
                    ramInput.after(errorMsg);
                }
            } else {
                if (ramError) {
                    ramError.remove();
                }
            }

            // Validasi input Tahun
            let tahunInput = document.getElementById('addTahun');
            let tahunError = document.getElementById('tahunError');
            if (isNaN(tahunInput.value) || tahunInput.value.trim() === '') {
                isValid = false;
                if (!tahunError) {
                    let errorMsg = document.createElement('p');
                    errorMsg.id = 'tahunError';
                    errorMsg.classList.add('text-red-500', 'text-sm');
                    errorMsg.textContent = 'Tahun harus berupa angka.';
                    tahunInput.after(errorMsg);
                }
            } else {
                if (tahunError) {
                    tahunError.remove();
                }
            }

            if (!isValid) {
                event.preventDefault();
            }
        });

    </script>
</x-layout-server>