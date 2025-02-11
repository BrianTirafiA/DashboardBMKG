<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Server Room : Rack</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<x-layout-server>
    <div id="modalTambahRak" class="fixed inset-0 z-50 bg-gray-800 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-lg p-6 w-1/3">
            <h3 class="text-lg font-bold mb-4">Tambah Rak Baru</h3>
            <form id="formTambahRak" method="POST" action="{{ route('rak.store') }}">
                @csrf
                <!-- Input Nama Rak -->
                <div class="mb-4">
                    <label for="namaRak" class="block text-sm font-medium text-gray-700">Nama Rak</label>
                    <input type="text" name="name" id="namaRak"
                        class="mt-1 block w-full border p-3 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        required>
                </div>

                <!-- Input Tipe Rak -->
                <div class="mb-4">
                    <label for="types" class="block text-sm font-medium text-gray-700">Tipe Rak</label>
                    <div class="relative">
                        <!-- Dropdown Tipe Rak -->
                        <select name="rack_type_id" id="tipeRak"
                            class="mt-1 block w-full border border-gray-300 p-3 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Pilih Tipe Rak</option>
                            @foreach ($rackTypes as $type)
                                <option value="1">{{ $type->name }}</option>
                            @endforeach
                        </select>

                    </div>
                </div>


                <!-- Footer Modal -->
                <div class="flex justify-end">
                    <button type="submit"
                        class="inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Simpan Rak
                    </button>
                    <button type="button" id="closeTambahRakModal"
                        class="ml-2 inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-gray-500 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout-server>

<script>
    document.getElementById("closeTambahRakModal").addEventListener("click", function () {
        // window.location.href = document.referrer || "/admin/itasset/dashboard";
        window.location.href = "/admin/itasset/dashboard";

    });


    document.getElementById("addTipeRakBtn").addEventListener("click", function () {
        // Logika untuk menambahkan tipe rak baru
        const newTipe = prompt("Masukkan Tipe Rak Baru:");
        if (newTipe) {
            const selectElement = document.getElementById("tipeRak");
            const newOption = document.createElement("option");
            newOption.value = newTipe;
            newOption.textContent = newTipe;
            selectElement.appendChild(newOption);
            selectElement.value = newTipe; // Pilih tipe rak baru setelah ditambahkan
        }
    });

</script>