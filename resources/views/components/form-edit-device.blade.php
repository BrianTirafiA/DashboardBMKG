@php 

    use App\Models\TypeDevice;
    // Ambil semua unit kerja dari database  
    $typeDevices = TypeDevice::all();  

@endphp

<div id="editModal" class="fixed inset-0 z-10 hidden bg-gray-800 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white rounded-lg p-6 w-1/3">
        <h3 class="text-lg font-bold mb-4">Edit Pengguna</h3>
        <form id="editForm" action="{{ route('device.update', '') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') 
            <input type="hidden" name="id" id="editDeviceId"> <!-- Input tersembunyi untuk ID -->

            <div class="mb-4">
                <label for="editDeviceName" class="block text-sm font-medium text-gray-700">Nama Perangkat</label>
                <input type="text" name="name_device" id="editDeviceName"
                    class="mt-1 block w-full border border-gray-300 rounded-md p-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    required>
            </div>

            <div class="mb-4">
                <label for="editDeviceBrand" class="block text-sm font-medium text-gray-700">Merek</label>
                <input type="text" name="brand_device" id="editDeviceBrand"
                    class="mt-1 block w-full border border-gray-300 rounded-md p-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    required>
            </div>

            <div class="mb-4">
                <label for="editDeviceType" class="block text-sm font-medium text-gray-700">Jenis</label>
                <select name="type_device" id="editDeviceType"
                    class="mt-1 block w-full border border-gray-300 rounded-md p-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
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
                <label for="editDeviceYear" class="block text-sm font-medium text-gray-700">Tahun</label>
                <input type="number" name="year_device" id="editDeviceYear"
                    class="mt-1 block w-full border border-gray-300 rounded-md  p-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                <small class="text-gray-500 text-xs mt-1">*Input harus berupa angka</small>

            </div>

            <div class="mb-4">
                <label for="editDeviceOS" class="block text-sm font-medium text-gray-700">OS</label>
                <input type="text" name="os_device" id="editDeviceOS"
                    class="mt-1 block w-full border border-gray-300 rounded-md p-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <div class="mb-4">
                <label for="editDeviceProcessor" class="block text-sm font-medium text-gray-700">Processor</label>
                <input type="text" name="processor_device" id="editDeviceProcessor"
                    class="mt-1 block w-full border border-gray-300 rounded-md p-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <div class="mb-4">
                <label for="editDeviceRAM" class="block text-sm font-medium text-gray-700">RAM</label>
                <input type="number" name="ram_device" id="editDeviceRAM"
                    class="mt-1 block w-full border border-gray-300 rounded-md p-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <div class="mb-4">
                <label for="editDeviceDisk" class="block text-sm font-medium text-gray-700">Disk</label>
                <input type="text" name="disk_device" id="editDeviceDisk"
                    class="mt-1 block w-full border border-gray-300 rounded-md p-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Update Perangkat
                </button>
                <button type="button" id="closeEditModal"
                    class="ml-2 inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-gray-500 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ADD TYPE -->
<div id="addTypeModal" class="fixed inset-0 z-60 hidden bg-gray-800 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white rounded-lg p-6 w-1/3">
        <h3 class="text-lg font-bold mb-4">Tambah Jenis Perangkat</h3>
        <form id="addTypeForm" action="{{ route('typeDevice.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="typeName" class="block text-sm font-medium text-gray-700">Nama Jenis</label>
                <input type="text" name="name_type" id="typeName"
                    class="mt-1 block w-full border border-gray-300 p-2 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
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