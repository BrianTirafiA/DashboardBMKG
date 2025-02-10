<x-layout-server>
<div class="container mx-auto p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-bold">Detail Rak - {{ $rack->name }}</h2>

            <button type="submit" form="rack-form" id="save-changes" 
                class="text-white px-4 py-2 rounded-lg bg-gray-300 transition"
                disabled>
                Simpan Perubahan
            </button>
            <form id="delete-rack-form" action="{{ url('/admin/itasset/rack/delete', $rack->id) }}" method="POST" class="hidden">
                @csrf
                @method('DELETE')
            </form>     

            <button id="delete-rack" data-id="{{ $rack->id }}" 
                class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
                Hapus Rak
            </button>
        </div>

        <form id="rack-form" action="{{ url('/admin/itasset/rack/update', $rack->id) }}" method="POST">
            @csrf
            <div class="w-full overflow-auto max-h-[80vh] border border-gray-300 shadow-md rounded-lg">
                <table class="w-full bg-white border border-gray-300">
                    <thead class="bg-gray-100 sticky top-0">
                        <tr>        
                            <th class="border px-6 py-3 min-w-[80px]">Posisi</th>
                            @foreach($rack->rackType->attributes->sortBy('id') as $attribute)
                                <th class="border px-6 py-3 min-w-[150px]">{{ $attribute->name }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(range(0, 42) as $rowIndex)
                            <tr class="hover:bg-gray-50">
                                <td class="border px-6 py-2 text-center">{{ $rowIndex + 1 }}</td>
                                @foreach($rack->rackType->attributes->sortBy('id') as $attribute)
                                    @php
                                        $value = $values[$attribute->id]->where('row_index', $rowIndex)->first()->value ?? '';
                                    @endphp
                                    <td class="border px-1 py-1 min-w-[150px] whitespace-nowrap">
                                        @if($attribute->name == 'Nama Device')
                                            <select class="device-dropdown border w-full px-2 py-1 focus:outline-none"
                                                name="rack[{{ $rack->id }}][{{ $attribute->id }}][{{ $rowIndex }}]"
                                                data-id="{{ $rack->id }}" 
                                                data-row="{{ $rowIndex }}">
                                                <option value=""></option>
                                                @foreach($devices as $device)
                                                    <option value="{{ $device->id }}" 
                                                        data-brand="{{ $device->brand_device }}"
                                                        data-type="{{ $device->type_device }}"
                                                        data-year="{{ $device->year_device }}"
                                                        data-os="{{ $device->os_device }}"
                                                        data-processor="{{ $device->processor_device }}"
                                                        data-ram="{{ $device->ram_device }}"
                                                        data-disk="{{ $device->disk_device }}"
                                                        {{ $value == $device->id ? 'selected' : '' }}>
                                                        {{ $device->name_device }}
                                                    </option>
                                                @endforeach 
                                            </select>
                                        @elseif($attribute->name == 'Status')
                                        @php
                                            $colorClass = match($value) {
                                                '1' => 'text-green-600', // Beroperasi
                                                '2' => 'text-yellow-600', // Stand By
                                                '3' => 'text-red-600', // Tidak Beroperasi
                                                default => 'text-gray-600',
                                            };
                                        @endphp
                                        <select class="status-dropdown border w-full px-2 py-1 focus:outline-none transition {{ $colorClass }}"
                                            name="rack[{{ $rack->id }}][{{ $attribute->id }}][{{ $rowIndex }}]">
                                            <option value=""></option>  
                                            @foreach($statuses as $status)
                                                @php
                                                    $optionColor = match($status->id) {
                                                        1 => 'text-green-600', 
                                                        2 => 'text-yellow-600', 
                                                        3 => 'text-red-600', 
                                                        default => 'text-gray-600',
                                                    };
                                                @endphp
                                                <option value="{{ $status->id }}" 
                                                    class="{{ $optionColor }}"
                                                    data-color="{{ $optionColor }}"
                                                    {{ $value == $status->id ? 'selected' : '' }}>
                                                    {{ $status->nama_status }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @elseif(in_array($attribute->name, ['Brand', 'Tipe', 'Tahun', 'OS', 'Processor', 'RAM', 'Disk']))
                                            <input type="text" class="readonly-input border w-full px-2 py-1 focus:outline-none" 
                                                name="rack[{{ $rack->id }}][{{ $attribute->id }}][{{ $rowIndex }}]"
                                                data-row="{{ $rowIndex }}" 
                                                data-attribute="{{ strtolower(str_replace(' ', '_', $attribute->name)) }}" 
                                                value="{{ $value }}" readonly>
                                        @elseif($attribute->name == 'PDU')
                                            <input type="text" class="pdu-input border w-full px-2 py-1 focus:outline-none"
                                                name="rack[{{ $rack->id }}][{{ $attribute->id }}][{{ $rowIndex }}]"
                                                data-id="{{ $rack->id }}" 
                                                data-row="{{ $rowIndex }}"
                                                value="{{ $value }}">
                                        @else       
                                            <input type="text" class="editable border w-full px-2 py-1 focus:outline-none"
                                                name="rack[{{ $rack->id }}][{{ $attribute->id }}][{{ $rowIndex }}]"
                                                data-id="{{ $rack->id }}" 
                                                data-attribute="{{ $attribute->id }}"
                                                data-row="{{ $rowIndex }}" 
                                                value="{{ $value }}">
                                        @endif
                                    </td>
                                @endforeach
                            </tr> 
                        @endforeach
                    </tbody>
                </table>
            </div>
        </form>
    </div>


    <!-- Modal Konfirmasi Hapus Rak -->
    <div id="delete-rack-modal"
        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
        <div class="bg-white rounded-lg shadow-lg p-6 w-1/3">
            <h2 class="text-lg font-semibold mb-4">Konfirmasi Penghapusan</h2>
            <p>Apakah Anda yakin ingin menghapus rak ini?</p>
            <p id="deleteRackName" class="font-bold"></p>
            <div class="mt-4 flex justify-end">
                <button id="cancel-delete-rack"
                    class="mr-2 px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
                    Batal
                </button>
                <button id="confirm-delete-rack"
                    class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                    Hapus
                </button>
            </div>
        </div>
    </div>

</x-layout-server>

<script>
    // Auto-save untuk input teks
    document.addEventListener("DOMContentLoaded", function () {
        const saveButton = document.getElementById("save-changes");
        const form = document.getElementById("rack-form");
        let changes = {}; // Objek untuk menyimpan perubahan

        // Auto-save untuk input teks
        document.querySelectorAll(".editable,.pdu-input").forEach(input => {
            input.addEventListener("input", function () {
                const rackId = this.dataset.id;
                const attributeId = this.dataset.attribute;
                const rowIndex = this.dataset.row;
                const value = this.value;

                // Simpan perubahan ke dalam objek changes
                if (!changes[rackId]) {
                    changes[rackId] = {};
                }
                if (!changes[rackId][attributeId]) {
                    changes[rackId][attributeId] = {};
                }
                changes[rackId][attributeId][rowIndex] = value;

                console.log("📌 Perubahan terbaru:", changes);

                // Aktifkan tombol "Simpan Perubahan"
                saveButton.classList.remove("bg-gray-300");
                saveButton.classList.add("bg-green-500", "hover:bg-green-700");
                saveButton.disabled = false;
            });
        });

        // Event listener untuk dropdown device
        document.querySelectorAll(".device-dropdown").forEach(select => {
            select.addEventListener("change", function () {
                const selectedOption = this.options[this.selectedIndex];
                const rowIndex = this.dataset.row;

                // Ambil data atribut dari opsi yang dipilih
                const brand = selectedOption.getAttribute("data-brand") || "";
                const type = selectedOption.getAttribute("data-type") || "";
                const year = selectedOption.getAttribute("data-year") || "";
                const os = selectedOption.getAttribute("data-os") || "";
                const processor = selectedOption.getAttribute("data-processor") || "";
                const ram = selectedOption.getAttribute("data-ram") || "";
                const disk = selectedOption.getAttribute("data-disk") || "";

                // Isi input terkait berdasarkan data device
                document.querySelector(`input[data-row="${rowIndex}"][data-attribute="brand"]`).value = brand;
                document.querySelector(`input[data-row="${rowIndex}"][data-attribute="tipe"]`).value = type;
                document.querySelector(`input[data-row="${rowIndex}"][data-attribute="tahun"]`).value = year;
                document.querySelector(`input[data-row="${rowIndex}"][data-attribute="os"]`).value = os;
                document.querySelector(`input[data-row="${rowIndex}"][data-attribute="processor"]`).value = processor;
                document.querySelector(`input[data-row="${rowIndex}"][data-attribute="ram"]`).value = ram;
                document.querySelector(`input[data-row="${rowIndex}"][data-attribute="disk"]`).value = disk;

                console.log(`🖥 Device di row ${rowIndex} diperbarui.`);
                saveButton.classList.remove("bg-gray-300");
                saveButton.classList.add("bg-green-500", "hover:bg-green-700");
                saveButton.disabled = false;
            });
        });

        // Klik tombol "Simpan Perubahan"
        saveButton.addEventListener("click", function () {
            if (Object.keys(changes).length === 0) return;

            console.log("🚀 Mengirim form ke server...");
            
            // Submit form secara manual
            form.submit();
        });
    });

    document.addEventListener("DOMContentLoaded", function () {
        const deleteButton = document.getElementById("delete-rack");
        const deleteModal = document.getElementById("delete-rack-modal");
        const confirmDeleteButton = document.getElementById("confirm-delete-rack");
        const cancelDeleteButton = document.getElementById("cancel-delete-rack");
        const deleteRackForm = document.getElementById("delete-rack-form");

        // Event saat tombol "Hapus Rak" ditekan
        deleteButton.addEventListener("click", function () {
            deleteModal.classList.remove("hidden");
        });

        // Event saat tombol "Batal" ditekan (tutup modal)
        cancelDeleteButton.addEventListener("click", function () {
            deleteModal.classList.add("hidden");
        });

        // Event saat tombol "Hapus" di modal ditekan (submit form)
        confirmDeleteButton.addEventListener("click", function () {
            deleteRackForm.submit();
        });
    });

    document.addEventListener("DOMContentLoaded", function () {
        const saveButton = document.getElementById("save-changes");

        function updateStatusColor(select, isInitialLoad = false) {
            const selectedOption = select.options[select.selectedIndex];
            const colorClass = selectedOption.dataset.color || "text-gray-600";

            // Hapus semua class warna sebelumnya
            select.classList.remove("text-green-600", "text-yellow-600", "text-red-600", "text-gray-600");

            // Tambahkan warna sesuai status
            select.classList.add(colorClass);

            // Jika ini bukan pemuatan awal, ubah tombol simpan
            if (!isInitialLoad) {
                saveButton.classList.remove("bg-gray-300");
                saveButton.classList.add("bg-green-500", "hover:bg-green-700");
                saveButton.disabled = false;
            }
        }

        // Terapkan warna awal untuk dropdown yang sudah memiliki nilai, tanpa mengaktifkan tombol
        document.querySelectorAll(".status-dropdown").forEach(select => {
            updateStatusColor(select, true); // Jangan ubah tombol saat halaman dimuat

            select.addEventListener("change", function () {
                updateStatusColor(this); // Ubah tombol hanya jika dropdown diubah
            });
        });
    });

    document.querySelectorAll(".pdu-dropdown").forEach(select => {
        const saveButton = document.getElementById("save-changes");

        select.addEventListener("change", function () {
            const rowIndex = this.getAttribute("data-row"); // Ambil rowIndex dari dropdown
            console.log(`🖥 PDU di row ${rowIndex} diperbarui.`);

            // Aktifkan tombol save
            saveButton.classList.remove("bg-gray-300");
            saveButton.classList.add("bg-green-500", "hover:bg-green-700");
            saveButton.disabled = false;
        });
    });

</script>

