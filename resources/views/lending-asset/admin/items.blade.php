<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Item - Admin</title>
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

@php
    use App\Models\ItemCategory;
    use App\Models\ItemLocation;
    use App\Models\ItemStatus;
    use App\Models\ItemBrand;
    $item_categories = ItemCategory::all();
    $item_brands = ItemBrand::all();
    $item_statuses = ItemStatus::all();
    $item_locations = ItemLocation::all();
@endphp

<x-lend-layout-template>
    <div>
        <div class="me-7 mt-1">
            @php                
                                                                                $title = 'Daftar Item Terdaftar';
                $description = 'Halaman ini berisi daftar item yang terdaftar yang dapat Anda kelola.';
                $add = 'Tambah Item Baru';
                $columns = [
                    ['key' => 'id', 'title' => 'ID'],
                    ['key' => 'nama_item', 'title' => 'Nama Item'],
                    ['key' => 'type_item', 'title' => 'Tipe Item'],
                    ['key' => 'brand.name_brand', 'title' => 'Merek'],
                    ['key' => 'tanggal_pengadaan', 'title' => 'Tanggal Pengadaan'],
                    ['key' => 'nama_vendor', 'title' => 'Nama Vendor'],
                    ['key' => 'jumlah_item', 'title' => 'Jumlah Item'],
                    ['key' => 'category.name_category', 'title' => 'Kategori'],
                    ['key' => 'status.name_status', 'title' => 'Status'],
                    ['key' => 'location.nama_lokasi', 'title' => 'Lokasi'],
                    ['key' => 'image1', 'title' => 'Gambar'],

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
                                <form action="{{ route('item.index') }}" method="GET"
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
                                        @foreach ($columns as $column)                                       
                                            <th
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
                                    @forelse ($item_details as $itemDetail)                                
                                        <tr>
                                            <td
                                                class="p-4 border-b border-blue-gray-100 text-sm text-blue-gray-900 text-center">
                                                {{ $item_details->firstItem() + $loop->index }}
                                            </td>
                                            @foreach ($columns as $column)  
                                                <td
                                                    class="p-4 border-b border-blue-gray-100 text-sm text-blue-gray-900 whitespace-normal break-words max-w-[150px]">

                                                    @if ($column['key'] === 'brand.name_brand')
                                                        {{ $itemDetail->brand ? $itemDetail->brand->name_brand : '-' }}
                                                    @elseif ($column['key'] === 'category.name_category')  
                                                        {{ $itemDetail->category ? $itemDetail->category->name_category : '-' }}
                                                    @elseif ($column['key'] === 'status.name_status')  
                                                        {{ $itemDetail->status ? $itemDetail->status->name_status : '-' }}
                                                    @elseif ($column['key'] === 'location.nama_lokasi')  
                                                        {{ $itemDetail->location ? $itemDetail->location->nama_lokasi : '-' }}
                                                    @elseif ($column['key'] === 'image1')  
                                                        <button type="button" class="text-blue-500"
                                                            onclick="openImageModal('{{ asset('storage/' . $itemDetail->image1) }}', '{{ asset('storage/' . $itemDetail->image2) }}', '{{ asset('storage/' . $itemDetail->image3) }}', '{{ asset('storage/' . $itemDetail->image4) }}')">
                                                            Lihat Gambar
                                                        </button>
                                                    @else
                                                        {{ $itemDetail->{$column['key']} }}
                                                    @endif
                                                </td>
                                            @endforeach

                                            <td class="border-b border-blue-gray-100">
                                                <div class="flex items-center gap-3 justify-center">
                                                    {{-- Tombol Edit --}}
                                                    <button type="button" class="text-blue-500 flex items-center gap-2"
                                                        onclick="openEditModal('{{ $itemDetail->id }}', '{{ $itemDetail->nama_item }}', '{{ $itemDetail->type_item }}', '{{ $itemDetail->brand_item_id }}', '{{ $itemDetail->tanggal_pengadaan }}', '{{ $itemDetail->nama_vendor }}', '{{ $itemDetail->jumlah_item }}', '{{ $itemDetail->kategori_item_id }}', '{{ $itemDetail->status_item_id }}', '{{ $itemDetail->lokasi_item_id }}')">
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
                                                    <form action="{{ route('items.destroy', $itemDetail->id) }}"
                                                        method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button"
                                                            class="text-red-500 flex items-center gap-1 delete-button"
                                                            data-id="{{ $itemDetail->id }}"
                                                            data-nama_item="{{ $itemDetail->nama_item }}"
                                                            onclick="showDeleteConfirmation(this)">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                                fill="currentColor" class="bi bi-trash3"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
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
                                                class="p-4 text-center text-sm text-blue-gray-900">Data item belum tersedia.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>

                            </table>
                        </div>
                    </div>

                    <div id="paginasi" class="flex items-center justify-between p-4 mt-1 border-t border-blue-gray-50">
                        <p class="block font-sans text-sm font-normal leading-normal text-blue-gray-900">
                            Total Data: {{ $item_details->total() }} | Page {{ $item_details->currentPage() }} of
                            {{ $item_details->lastPage() }}
                        </p>
                        <div class="flex gap-2 me-2">
                            @if($item_details->onFirstPage())
                                <span
                                    class="select-none rounded-lg border border-gray-900 py-2 px-4 text-center font-sans text-xs font-bold uppercase text-gray-900 transition-all opacity-50 cursor-not-allowed">
                                    Previous
                                </span>
                            @else
                                <a href="{{ $item_details->previousPageUrl() . (request('search') ? '&search=' . urlencode(request('search')) : '') }}"
                                    class="select-none rounded-lg border border-gray-900 py-2 px-4 text-center font-sans text-xs font-bold uppercase text-gray-900 transition-all hover:opacity-75">
                                    Previous
                                </a>
                            @endif
                            @if($item_details->hasMorePages())
                                <a href="{{ $item_details->nextPageUrl() . (request('search') ? '&search=' . urlencode(request('search')) : '') }}"
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

                    <div id="paginasi" class="flex items-center justify-between p-4 mt-1 border-t border-blue-gray-50">

                    </div>

                </div>

                <!-- Modal untuk Tambah Item -->
                <div id="addModal"
                    class="fixed inset-0 z-50 hidden bg-gray-800 bg-opacity-50 flex items-center justify-center">
                    <div class="bg-white rounded-lg p-6 w-1/3">
                        <h3 class="text-lg font-bold mb-4">Tambah Item Baru</h3>
                        <form id="addForm" action="{{ route('items.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="flex flex-row w-full space-x-8 justify-center">
                                <div class="w-1/2">
                                    <div class="mb-4">
                                        <label for="addNamaItem"
                                            class="block text-sm font-medium text-gray-700 mb-2">Nama Item</label>
                                        <input type="text" name="nama_item" id="addNamaItem"
                                            class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-md outline-blue-600"
                                            placeholder="Tambahkan Nama Item Baru" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="addTypeItem"
                                            class="block text-sm font-medium text-gray-700 mb-2">Tipe Item</label>
                                        <input type="text" name="type_item" id="addTypeItem"
                                            class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-md outline-blue-600"
                                            placeholder="Tambahkan Tipe Item Baru" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="addBrandItem"
                                            class="block text-sm font-medium text-gray-700 mb-2">Merek Item</label>
                                        <select name="brand_item_id" id="addBrandItem"
                                            class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-md outline-blue-600"
                                            required>
                                            <option value="">Pilih Merek</option>
                                            @foreach($item_brands as $itemBrand)  
                                                <option value="{{ $itemBrand->id }}">{{ $itemBrand->name_brand }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label for="addTanggalPengadaan"
                                            class="block text-sm font-medium text-gray-700 mb-2">Tanggal
                                            Pengadaan</label>
                                        <input type="date" name="tanggal_pengadaan" id="addTanggalPengadaan"
                                            class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-md outline-blue-600">
                                    </div>
                                    <div class="mb-4">
                                        <label for="addNamaVendor"
                                            class="block text-sm font-medium text-gray-700 mb-2">Nama Vendor</label>
                                        <input type="text" name="nama_vendor" id="addNamaVendor"
                                            class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-md outline-blue-600"
                                            placeholder="Tambahkan Nama Vendor Baru">
                                    </div>
                                    <div class="mb-4">
                                        <label for="addJumlahItem"
                                            class="block text-sm font-medium text-gray-700 mb-2">Jumlah Item</label>
                                        <input type="number" name="jumlah_item" id="addJumlahItem"
                                            class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-md outline-blue-600"
                                            placeholder="Tambahkan Jumlah Item Baru" required>
                                    </div>

                                </div>

                                <div>
                                    <div class="mb-4">
                                        <label for="addKategoriItem"
                                            class="block text-sm font-medium text-gray-700 mb-2">Kategori Item</label>
                                        <select name="kategori_item_id" id="addKategoriItem"
                                            class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-md outline-blue-600"
                                            required>
                                            <option value="">Pilih Kategori</option>
                                            @foreach($item_categories as $itemCategory)  
                                                <option value="{{ $itemCategory->id }}">{{ $itemCategory->name_category }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label for="addStatusItem"
                                            class="block text-sm font-medium text-gray-700 mb-2">Status Item</label>
                                        <select name="status_item_id" id="addStatusItem"
                                            class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-md outline-blue-600"
                                            required>
                                            <option value="">Pilih Status</option>
                                            @foreach($item_statuses as $itemStatus)  
                                                <option value="{{ $itemStatus->id }}">{{ $itemStatus->name_status }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label for="addLokasiItem"
                                            class="block text-sm font-medium text-gray-700 mb-2">Lokasi Item</label>
                                        <select name="lokasi_item_id" id="addLokasiItem"
                                            class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-md outline-blue-600"
                                            required>
                                            <option value="">Pilih Lokasi</option>
                                            @foreach($item_locations as $itemLocation)  
                                                <option value="{{ $itemLocation->id }}">{{ $itemLocation->nama_lokasi }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="addImage1"
                                            class="block text-sm font-medium text-gray-700 mb-2">Gambar 1</label>
                                        <input type="file" name="image1" id="addImage1"
                                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="addImage2"
                                            class="block text-sm font-medium text-gray-700 mb-2">Gambar 2</label>
                                        <input type="file" name="image2" id="addImage2"
                                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="addImage3"
                                            class="block text-sm font-medium text-gray-700 mb-2">Gambar 3</label>
                                        <input type="file" name="image3" id="addImage3"
                                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="addImage4"
                                            class="block text-sm font-medium text-gray-700 mb-2">Gambar 4</label>
                                        <input type="file" name="image4" id="addImage1"
                                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <div class="flex justify-end">
                                <button type="submit"
                                    class="inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Simpan Item
                                </button>
                                <button type="button" id="closeAddModal"
                                    class="ml-2 inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-gray-500 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                    Batal
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Modal untuk Edit Item -->
                <div id="editModal"
                    class="fixed inset-0 z-50 hidden bg-gray-800 bg-opacity-50 flex items-center justify-center">
                    <div class="bg-white rounded-lg p-6 w-1/2">
                        <h3 class="text-lg font-bold mb-4">Edit Item</h3>
                        <form id="editForm" action="{{ route('items.update', '') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT') <input type="hidden" name="id" id="editItemId">

                                <div class="flex flex-row w-full space-x-10 justify-center">
                                    <div class="w-1/2">
                                        <div class="mb-4">
                                            <label for="editNamaItem"
                                                class="block text-sm font-medium text-gray-700 mb-2">Nama Item</label>
                                            <input type="text" name="nama_item" id="editNamaItem"
                                                class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-md outline-blue-600"
                                                placeholder="Tambahkan Nama Item Terbaru" required>
                                        </div>
                                        <div class="mb-4">
                                            <label for="editTypeItem"
                                                class="block text-sm font-medium text-gray-700 mb-2">Tipe Item</label>
                                            <input type="text" name="type_item" id="editTypeItem"
                                                class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-md outline-blue-600"
                                                placeholder="Tambahkan Tipe Item Terbaru" required>
                                        </div>
                                        <div class="mb-4">
                                            <label for="editBrandItem"
                                                class="block text-sm font-medium text-gray-700 mb-2">Merek Item</label>
                                            <select name="brand_item_id" id="editBrandItem"
                                                class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-md outline-blue-600"
                                                required>
                                                <option value="">Pilih Merek</option>
                                                @foreach($item_brands as $itemBrand)  
                                                    <option value="{{ $itemBrand->id }}">{{ $itemBrand->name_brand }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-4">
                                            <label for="editTanggalPengadaan"
                                                class="block text-sm font-medium text-gray-700 mb-2">Tanggal
                                                Pengadaan</label>
                                            <input type="date" name="tanggal_pengadaan" id="editTanggalPengadaan"
                                                class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-md outline-blue-600">
                                        </div>
                                        <div class="mb-4">
                                            <label for="editNamaVendor"
                                                class="block text-sm font-medium text-gray-700 mb-2">Nama Vendor</label>
                                            <input type="text" name="nama_vendor" id="editNamaVendor"
                                                class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-md outline-blue-600"
                                                placeholder="Tambahkan Nama Vendor Terbaru">
                                        </div>
                                        <div class="mb-4">
                                            <label for="editJumlahItem"
                                                class="block text-sm font-medium text-gray-700 mb-2">Jumlah Item</label>
                                            <input type="number" name="jumlah_item" id="editJumlahItem"
                                                class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-md outline-blue-600"
                                                placeholder="Tambahkan Jumlah Item Terbaru" required>
                                        </div>
                                        <div class="mb-4">
                                            <label for="editKategoriItem"
                                                class="block text-sm font-medium text-gray-700 mb-2">Kategori
                                                Item</label>
                                            <select name="kategori_item_id" id="editKategoriItem"
                                                class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-md outline-blue-600"
                                                required>
                                                <option value="">Pilih Kategori</option>
                                                @foreach($item_categories as $itemCategory)  
                                                    <option value="{{ $itemCategory->id }}">
                                                        {{ $itemCategory->name_category }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-4">
                                            <label for="editStatusItem"
                                                class="block text-sm font-medium text-gray-700 mb-2">Status Item</label>
                                            <select name="status_item_id" id="editStatusItem"
                                                class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-md outline-blue-600"
                                                required>
                                                <option value="">Pilih Status</option>
                                                @foreach($item_statuses as $itemStatus)  
                                                    <option value="{{ $itemStatus->id }}">{{ $itemStatus->name_status }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-4">
                                            <label for="editLokasiItem"
                                                class="block text-sm font-medium text-gray-700 mb-2">Lokasi Item</label>
                                            <select name="lokasi_item_id" id="editLokasiItem"
                                                class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-md outline-blue-600"
                                                required>
                                                <option value="">Pilih Lokasi</option>
                                                @foreach($item_locations as $itemLocation)  
                                                    <option value="{{ $itemLocation->id }}">{{ $itemLocation->nama_lokasi }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="mb-4">
                                            <label for="editImage1"
                                                class="block text-sm font-medium text-gray-700 mb-2">Gambar 1</label>
                                            <input type="file" name="image1" id="editImage1"
                                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                                            <!-- Display current image if exists -->
                                            @if($itemDetail->image1)
                                                <img src="{{ asset('storage/' . $itemDetail->image1) }}"
                                                    alt="Current Image 1"
                                                    class="w-32 h-32 border border-gray-300 p-2 rounded-2xl mx-auto">
                                            @endif
                                        </div>
                                        <div class="mb-4">
                                            <label for="editImage2"
                                                class="block text-sm font-medium text-gray-700 mb-2">Gambar 2</label>
                                            <input type="file" name="image2" id="editImage2"
                                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                                            <!-- Display current image if exists -->
                                            @if($itemDetail->image2)
                                                <img src="{{ asset('storage/' . $itemDetail->image2) }}"
                                                    alt="Current Image 1"
                                                    class="w-32 h-32 border border-gray-300 p-2 rounded-2xl mx-auto">
                                            @endif
                                        </div>
                                        <div class="mb-4">
                                            <label for="editImage3"
                                                class="block text-sm font-medium text-gray-700 mb-2">Gambar 3</label>
                                            <input type="file" name="image3" id="editImage3"
                                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                                            <!-- Display current image if exists -->
                                            @if($itemDetail->image3)
                                                <img src="{{ asset('storage/' . $itemDetail->image3) }}"
                                                    alt="Current Image 1"
                                                    class="w-32 h-32 border border-gray-300 p-2 rounded-2xl mx-auto">
                                            @endif
                                        </div>
                                        <div class="mb-4">
                                            <label for="editImage4"
                                                class="block text-sm font-medium text-gray-700 mb-2">Gambar 4</label>
                                            <input type="file" name="image4" id="editImage4"
                                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                                            <!-- Display current image if exists -->
                                            @if($itemDetail->image4)
                                                <img src="{{ asset('storage/' . $itemDetail->image4) }}"
                                                    alt="Current Image 1"
                                                    class="w-32 h-32 border border-gray-300 p-2 rounded-2xl mx-auto">
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="flex justify-end">
                                    <button type="submit"
                                        class="inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Update Item
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
                        <p>Apakah Anda yakin ingin menghapus item ini?</p>
                        <p id="deleteItemName" class="font-bold"></p>
                        <div class="mt-4 flex justify-end">
                            <button id="cancel-delete"
                                class="mr-2 px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">Batal</button>
                            <button id="confirm-delete"
                                class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Hapus</button>
                        </div>
                    </div>
                </div>

                <!-- Modal untuk Menampilkan Gambar -->
                <div id="imageModal"
                    class="fixed inset-0 z-50 hidden bg-gray-800 bg-opacity-50 flex items-center justify-center">
                    <div class="bg-white rounded-lg p-6 w-1/2">
                        <h3 class="text-lg font-bold mb-4">Gambar Item</h3>
                        <div class="flex flex-wrap justify-center">
                            <img id="modalImage1" src="" alt="Image 1" class="w-1/2 h-auto mb-4">
                            <img id="modalImage2" src="" alt="Image 2" class="w-1/2 h-auto mb-4">
                            <img id="modalImage3" src="" alt="Image 3" class="w-1/2 h-auto mb-4">
                            <img id="modalImage4" src="" alt="Image 4" class="w-1/2 h-auto mb-4">
                        </div>
                        <button type="button" id="closeImageModal"
                            class="mt-4 inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-gray-500 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">Tutup</button>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <script>
        // Menampilkan modal untuk menambah item                  
        function openAddModal() {
            document.getElementById('addForm').reset(); // Reset form                  
            document.getElementById('addModal').classList.remove('hidden'); // Tampilkan modal                  
        }

        // Menutup modal untuk menambah item                  
        document.getElementById('closeAddModal').addEventListener('click', () => {
            document.getElementById('addModal').classList.add('hidden');
        });

        // Menampilkan modal untuk mengedit item                
        function openEditModal(id, nama_item, type_item, brand_item_id, tanggal_pengadaan, nama_vendor, jumlah_item, kategori_item_id, status_item_id, lokasi_item_id) {
            document.getElementById('editItemId').value = id; // Set ID item    
            document.getElementById('editNamaItem').value = nama_item; // Set value Nama Item    
            document.getElementById('editTypeItem').value = type_item; // Set value Tipe Item    
            document.getElementById('editBrandItem').value = brand_item_id; // Set value Merek Item    
            document.getElementById('editTanggalPengadaan').value = tanggal_pengadaan; // Set value Tanggal Pengadaan    
            document.getElementById('editNamaVendor').value = nama_vendor; // Set value Nama Vendor    
            document.getElementById('editJumlahItem').value = jumlah_item; // Set value Jumlah Item    
            document.getElementById('editKategoriItem').value = kategori_item_id; // Set value Kategori Item    
            document.getElementById('editStatusItem').value = status_item_id; // Set value Status Item    
            document.getElementById('editLokasiItem').value = lokasi_item_id; // Set value Lokasi Item    

            // Set action form edit    
            document.getElementById('editForm').action = "{{ route('items.update', '') }}/" + id; // Set action form edit    

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
            const itemId = button.dataset.id; // Get item ID        
            const namaItem = button.dataset.nama_item; // Get item name        
            document.getElementById('deleteItemName').textContent = namaItem; // Set item name in modal        
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
                currentDeleteForm.submit(); // Submit the form to delete the item        
            }
            document.getElementById('delete-confirmation-modal').classList.add('hidden'); // Hide modal        
        });

        function openImageModal(image1, image2, image3, image4) {
            document.getElementById('modalImage1').src = image1;
            document.getElementById('modalImage2').src = image2;
            document.getElementById('modalImage3').src = image3;
            document.getElementById('modalImage4').src = image4;

            document.getElementById('imageModal').classList.remove('hidden');
        }

        // Menutup modal gambar  
        document.getElementById('closeImageModal').addEventListener('click', () => {
            document.getElementById('imageModal').classList.add('hidden');
        });

    </script>
</x-lend-layout-template>