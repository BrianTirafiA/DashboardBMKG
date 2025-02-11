@php 

                                                    use App\Models\TypeDevice;
    $typeDevices = TypeDevice::all();  

@endphp

<div id="addModal" class="fixed inset-0 z-50 hidden bg-gray-800 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white rounded-lg p-6 w-1/3">
        <h3 class="text-lg font-bold mb-4">Tambah Perangkat Baru</h3>
        <form id="addForm" action="{{ route('device.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="addNamaPerangkat" class="block text-sm font-medium text-gray-700">Nama Perangkat</label>
                <input type="text" name="name_device" id="addNamaPerangkat"
                    class="mt-1 block w-full border border-gray-300 p-2 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    required>
            </div>
            <div class="mb-4">
                <label for="addBrand" class="block text-sm font-medium text-gray-700">Merek</label>
                <input type="text" name="brand_device" id="addBrand"
                    class="mt-1 block w-full border border-gray-300 p-2 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    required>
            </div>
            <div class="mb-4">
                <label for="addJenis" class="block text-sm font-medium text-gray-700">Jenis</label>
                <select name="type_device" id="addJenis"
                    class="mt-1 block w-full border border-gray-300 p-2 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    required>
                    <option value="" disabled selected>Pilih Jenis</option>
                    @foreach ($typeDevices as $tipe_device)
                        <option value="{{ $tipe_device->name_type }}">{{ $tipe_device->name_type }}</option>
                    @endforeach
                </select>

                <button type="button" onclick="openAddTypeModal()"
                    class="mt-2 inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    Tambah Jenis Perangkat
                </button>

            </div>

            <div class="mb-4">
                <label for="addTahun" class="block text-sm font-medium text-gray-700 mb-2">Tahun</label>
                <input type="number" name="year_device" id="addTahun"
                    class="mt-1 block w-full border border-gray-300 p-2 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 h-[30px] py-2">
                <small class="text-gray-500 text-xs mt-1">*Input harus berupa angka</small>
            </div>


            <div class="mb-4">
                <label for="addOS" class="block text-sm font-medium text-gray-700">OS</label>
                <input type="text" name="os_device" id="addOS"
                    class="mt-1 block w-full border border-gray-300 p-2 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    required>
            </div>
            <div class="mb-4">
                <label for="addProcessor" class="block text-sm font-medium text-gray-700">Processor</label>
                <input type="text" name="processor_device" id="addProcessor"
                    class="mt-1 block w-full border border-gray-300 p-2 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    required>
            </div>
            <div class="mb-4">
                <label for="addRAM" class="block text-sm font-medium text-gray-700">RAM</label>
                <input type="number" name="ram_device" id="addRAM"
                    class="mt-1 block w-full border border-gray-300 p-2 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    required>
            </div>
            <div class="mb-4">
                <label for="addDisk" class="block text-sm font-medium text-gray-700">Disk</label>
                <input type="text" name="disk_device" id="addDisk"
                    class="mt-1 block w-full border border-gray-300 p-2 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    required>
            </div>
            <div class="flex justify-end">
                <button type="submit"
                    class="inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Simpan Perangkat
                </button>
                <button type="button" id="closeAddModal"
                    class="ml-2 inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-gray-500 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ADD TYPE -->
<div id="addTypeModal" class="fixed inset-0 z-50 hidden bg-gray-800 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white rounded-lg p-6 w-1/3">
        <h3 class="text-lg font-bold mb-4">Tambah Jenis Perangkat</h3>
        <form id="addTypeForm" action="{{ route('typeDevice.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="typeName" class="block text-sm font-medium text-gray-700">Nama Jenis</label>
                <input type="text" name="name_type" id="typeName"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    required>
            </div>
            <div class="flex justify-end">
                <button type="submit"
                    class="inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Simpan Jenis
                </button>
                <button type="button" id="closeAddTypeModal"
                    class="ml-2 inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-gray-500 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>


<script>
    function openAddTypeModal() {
        // Tampilkan modal Add Type
        document.getElementById("addTypeModal").classList.remove("hidden");
        document.getElementById("addTypeModal").classList.add("flex");
    }

    // Fungsi untuk menutup modal
    document.getElementById("closeAddTypeModal").addEventListener("click", function () {
        document.getElementById("addTypeModal").classList.add("hidden");
        document.getElementById("addTypeModal").classList.remove("flex");
    });

</script>