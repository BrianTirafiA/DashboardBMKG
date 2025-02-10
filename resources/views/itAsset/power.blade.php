<head>
    <title>
        Server Room : Power
    </title>
</head>

<x-layout-server>
    <!-- Tabel Rak Panel -->
    <div class="p-6 bg-white shadow-lg rounded-lg">
        <div class="flex justify-between items-center mb-4 text-center">
            <div>
                <h1 class="text-lg font-semibold text-blue-gray-900 text-center">
                    Daftar Rak Panel
                </h1>
                <p class="text-blue-gray-700">
                    Tabel di bawah menunjukkan distribusi power yang digunakan di rak server.
                </p>
            </div>
            <button id="btnTambahRak" class="px-4 py-2 rounded-lg bg-blue-600 text-white shadow-md hover:shadow-lg">
                Tambah Rak
            </button>

            <form action="{{ route('power.updatePanelData') }}" method="POST">
                @csrf
                <button type="submit" class="px-4 py-2 rounded-lg bg-yellow-500 text-white shadow-md hover:shadow-lg">
                    Update Data Panel
                </button>
            </form>

        </div>

        <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($rakPanels as $rakPanel)
                <div class="p-6 bg-white shadow-lg rounded-lg">
                    <h2 class="text-lg font-semibold text-blue-gray-900 mb-4 text-center">
                        Panel {{ $rakPanel->name }}
                    </h2>
                    <button class="px-4 py-2 rounded-lg bg-red-500 text-white shadow-md hover:shadow-lg delete-button"
                        onclick="showDeleteConfirmation(this)" data-id="{{ $rakPanel->id }}"
                        data-name="{{ $rakPanel->name }}">
                        Hapus
                    </button>

                    <table class="mt-4 text-left border-collapse table-auto min-w-full">
                        <thead>
                            <tr>
                                <th
                                    class="p-4 border-y border-blue-gray-100 bg-blue-gray-50 text-sm font-normal text-blue-gray-900">
                                    PDU</th>
                                <th
                                    class="p-4 border-y border-blue-gray-100 bg-blue-gray-50 text-sm font-normal text-blue-gray-900">
                                    Rak</th>

                                <th
                                    class="p-4 border-y border-blue-gray-100 bg-blue-gray-50 text-sm font-normal text-blue-gray-900">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rakPanel->panels as $panel)
                                <tr>
                                    <td class="p-4 border-b border-blue-gray-100 text-sm text-blue-gray-900">{{ $panel->pdu }}
                                    </td>
                                    <td class="p-4 border-b border-blue-gray-100 text-sm text-blue-gray-900">
                                        {{ $panel->rak ?? '-' }}
                                    </td>
                                    <td class="p-4 border-b border-blue-gray-100 text-sm text-blue-gray-900">
                                        <button class="text-red-500 flex items-center gap-1 delete-button"
                                            onclick="showDeleteConfirmationPanel(this)" data-id="{{ $panel->id }}"
                                            data-name="{{ $panel->pdu }}">

                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                                class="bi bi-trash3" viewBox="0 0 16 16">
                                                <path
                                                    d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <form action="{{ route('power.addPanel', $rakPanel->id) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="w-full px-4 py-2 rounded-lg bg-green-500 text-white text-center shadow-md hover:shadow-lg">Tambah
                            PDU</button>
                    </form>
                </div>

            @endforeach
        </div>
    </div>

    <!-- Form untuk menambahkan rak -->
    <div id="formTambahRak"
        class="fixed inset-0 z-10 hidden bg-gray-800 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-lg p-6 w-1/3">
            @if ($errors->any())
                <div class="mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="text-red-500">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('power.store') }}">
                @csrf
                <label for="name" class="block mb-2">Nama Rak:</label>
                <input type="text" id="inputNamaRak" name="name" class="p-2 border border-blue-gray-200 rounded-md"
                    placeholder="Masukkan nama rak" required />
                <button type="submit" id="submitTambahRak"
                    class="px-4 py-2 mt-4 bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 text-white rounded-md">
                    Tambah
                </button>
                <button type="button" id="cancelTambahRak"
                    class="px-4 py-2 mt-4 text-white rounded-md text-gray-500 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    Batal
                </button>
            </form>
        </div>
    </div>

    <!-- Modal Konfirmasi Penghapusan Rak -->
    <div id="delete-confirmation-modal"
        class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg p-6 w-1/3">
            <h2 class="text-lg font-semibold mb-4">Konfirmasi Penghapusan</h2>
            <p>Apakah Anda yakin ingin menghapus rak panel ini?</p>
            <p id="deleteItemName" class="font-bold"></p>
            <div class="mt-4 flex justify-end">
                <button id="cancel-delete-rak"
                    class="mr-2 px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">Batal</button>
                <form action="{{ route('power.destroy', '') }}" id="delete-form" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Hapus</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Penghapusan Panel -->
    <div id="delete-confirmation-modal-panel"
        class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg p-6 w-1/3">
            <h2 class="text-lg font-semibold mb-4">Konfirmasi Penghapusan</h2>
            <p>Apakah Anda yakin ingin menghapus panel ini?</p>
            <p id="deleteItemNamePanel" class="font-bold"></p>
            <div class="mt-4 flex justify-end">
                <button id="cancel-delete-panel"
                    class="mr-2 px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">Batal</button>
                <form action="{{ route('power.destroy_panel', '') }}" id="delete-form-panel" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Hapus</button>
                </form>
            </div>
        </div>
    </div>

</x-layout-server>

<script>

    function showDeleteConfirmation(button) {
        const rakId = button.dataset.id; // Ambil ID rak dari atribut data-id
        const rakName = button.dataset.name; // Ambil nama rak dari atribut data-name

        // Perbarui teks nama rak di modal
        document.getElementById('deleteItemName').textContent = `${rakName}`;

        // Update action form dengan ID rak
        const formDeleteRak = document.querySelector('#delete-form');
        formDeleteRak.action = `/admin/itasset/power/${rakId}`;  // Update action form

        // Tampilkan modal konfirmasi
        document.getElementById('delete-confirmation-modal').classList.remove('hidden');
    }


    function showDeleteConfirmationPanel(button) {
        const panelId = button.dataset.id; // Ambil ID panel dari atribut data-id
        const panelName = button.dataset.name; // Ambil nama panel dari atribut data-name

        // Perbarui teks nama panel di modal
        document.getElementById('deleteItemNamePanel').textContent = `${panelName}`;

        // Update form action untuk penghapusan panel
        const formDeletePanel = document.querySelector('#delete-form-panel');
        formDeletePanel.action = `/admin/itasset/power/panel/${panelId}`;

        // Tampilkan modal konfirmasi
        document.getElementById('delete-confirmation-modal-panel').classList.remove('hidden');
    }

    document.getElementById('cancel-delete-panel').addEventListener('click', () => {
        document.getElementById('delete-confirmation-modal-panel').classList.add('hidden');
    });


    document.getElementById('cancel-delete-rak').addEventListener('click', () => {
        document.getElementById('delete-confirmation-modal').classList.add('hidden');
    });

    document.getElementById('btnTambahRak').addEventListener('click', () => {
        document.getElementById('formTambahRak').classList.remove('hidden');
    });

    document.getElementById('cancelTambahRak').addEventListener('click', () => {
        document.getElementById('formTambahRak').classList.add('hidden');
    });

</script>