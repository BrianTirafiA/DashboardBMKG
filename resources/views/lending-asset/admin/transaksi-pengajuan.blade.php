<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Permintaan Peminjaman - Admin</title>
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
                                                                                                                                                                $title = 'Daftar Permintaan Peminjaman';
                $description = 'Halaman ini berisi daftar permintaan peminjaman yang dapat Anda kelola.';
                $columns = [
                    ['key' => 'id', 'title' => 'ID'],
                    ['key' => 'user.name', 'title' => 'Nama Pemohon'],
                    ['key' => 'durasi_peminjaman', 'title' => 'Durasi (Hari)'],
                    ['key' => 'alasan_peminjaman', 'title' => 'Alasan'],
                    ['key' => 'tanggal_pengajuan', 'title' => 'Tanggal Pengajuan'],
                    ['key' => 'berkas_pendukung', 'title' => 'Berkas Pendukung'],
                    ['key' => 'items', 'title' => 'Item (Jumlah)'], // Kolom baru untuk item  
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
                                <form action="{{ route('pengajuan.index') }}" method="GET"
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
    @forelse ($loan_requests as $loanRequest)  
        <tr>  
            <td class="p-4 border-b border-blue-gray-100 text-sm text-blue-gray-900 text-center">  
                {{ $loan_requests->firstItem() + $loop->index }}  
            </td>  
            @foreach ($columns as $column)  
                <td class="p-4 border-b border-blue-gray-100 text-sm text-blue-gray-900 whitespace-normal break-words max-w-[150px]">  
                    @if ($column['key'] === 'user.name')  
                        <span class="text-blue-500 cursor-pointer" onclick="openUserModal('{{ $loanRequest->user->fullname }}', '{{ $loanRequest->user->email }}', '{{ $loanRequest->user->no_telepon }}')">  
                            {{ $loanRequest->user ? $loanRequest->user->fullname : '-' }}  
                        </span>  
                    @elseif ($column['key'] === 'berkas_pendukung')  
                        @if ($loanRequest->berkas_pendukung)  
                            <a href="{{ asset('storage/' . $loanRequest->berkas_pendukung) }}" target="_blank" class="text-blue-500">Lihat Berkas</a>  
                        @else  
                            -  
                        @endif  
                    @elseif ($column['key'] === 'items')  
                        <ul>  
                            @foreach ($loanRequest->items as $item)  
                                <li>  
                                    {{ $item->itemDetail ? $item->itemDetail->nama_item : 'Item tidak ditemukan' }}  
                                    ({{ $item->quantity }})  
                                </li>  
                            @endforeach  
                        </ul>  
                    @else  
                        {{ $loanRequest->{$column['key']} }}  
                    @endif  
                </td>  
            @endforeach  
  
            <td class="border-b border-blue-gray-100">  
                <div class="flex items-center gap-3 justify-center">  
                    <!-- Tombol Terima Permintaan -->  
                    <button type="button" class="text-blue-500 flex items-center gap-2"  
                        onclick="openEditModal('{{ $loanRequest->id }}', '{{ $loanRequest->user_id }}', '{{ $loanRequest->durasi_peminjaman }}', '{{ $loanRequest->alasan_peminjaman }}', '{{ $loanRequest->tanggal_pengajuan }}', '{{ $loanRequest->berkas_pendukung }}')">  
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">  
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />  
                            <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05" />  
                        </svg>  
                        Terima  
                    </button>  
                    {{-- Tombol Tolak Permintaan --}}  
                    <form action="{{ route('transaksi-pengajuan.destroy', $loanRequest->id) }}" method="POST" class="inline">  
                        @csrf  
                        @method('DELETE')  
                        <button type="button" class="text-red-500 flex items-center gap-1 delete-button"  
                            data-id="{{ $loanRequest->id }}"  
                            data-nama_item="{{ $loanRequest->items->map(function ($item) { return $item->itemDetail ? $item->itemDetail->nama_item : 'Item tidak ditemukan'; })->join(', ') }}"  
                            onclick="showDeleteConfirmation(this)">  
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-octagon" viewBox="0 0 16 16">  
                                <path d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1z" />  
                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />  
                            </svg>  
                            Tolak  
                        </button>  
                    </form>  
                </div>  
            </td>  
        </tr>  
    @empty  
        <tr>  
            <td colspan="{{ count($columns) + 2 }}" class="p-4 text-center text-sm text-blue-gray-900">Data permintaan peminjaman belum tersedia.</td>  
        </tr>  
    @endforelse  
</tbody>  



                            </table>
                        </div>
                    </div>

                    <div id="paginasi" class="flex items-center justify-between p-4 mt-1 border-t border-blue-gray-50">
                        <p class="block font-sans text-sm font-normal leading-normal text-blue-gray-900">
                            Total Data: {{ $loan_requests->total() }} | Page {{ $loan_requests->currentPage() }} of
                            {{ $loan_requests->lastPage() }}
                        </p>
                        <div class="flex gap-2 me-2">
                            @if($loan_requests->onFirstPage())
                                <span
                                    class="select-none rounded-lg border border-gray-900 py-2 px-4 text-center font-sans text-xs font-bold uppercase text-gray-900 transition-all opacity-50 cursor-not-allowed">
                                    Previous
                                </span>
                            @else
                                <a href="{{ $loan_requests->previousPageUrl() . (request('search') ? '&search=' . urlencode(request('search')) : '') }}"
                                    class="select-none rounded-lg border border-gray-900 py-2 px-4 text-center font-sans text-xs font-bold uppercase text-gray-900 transition-all hover:opacity-75">
                                    Previous
                                </a>
                            @endif
                            @if($loan_requests->hasMorePages())
                                <a href="{{ $loan_requests->nextPageUrl() . (request('search') ? '&search=' . urlencode(request('search')) : '') }}"
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
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk Menampilkan Data Pengguna -->  
<div id="userModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">  
    <div class="bg-white rounded-lg p-6 w-1/3">  
        <h2 class="text-lg font-semibold mb-4">Detail Pengguna</h2>  
        <p><strong>Nama:</strong> <span id="modalUserName"></span></p>  
        <p><strong>Email:</strong> <span id="modalUserEmail"></span></p>  
        <p><strong>Telepon:</strong> <span id="modalUserPhone"></span></p>  
        <div class="flex justify-end mt-4">  
            <button id="closeUserModal" class="bg-blue-500 text-white px-4 py-2 rounded">Tutup</button>  
        </div>  
    </div>  
</div>  
  
<script>  
function openUserModal(fullname, email, no_telepon) {  
    document.getElementById('modalUserName').textContent = fullname;  
    document.getElementById('modalUserEmail').textContent = email;  
    document.getElementById('modalUserPhone').textContent = no_telepon;  
    document.getElementById('userModal').classList.remove('hidden');  
}  
  
// Event listener untuk menutup modal  
document.getElementById('closeUserModal').addEventListener('click', function () {  
    document.getElementById('userModal').classList.add('hidden');  
});  
</script>  


    <script>
        function openEditModal(id, user_id, durasi_peminjaman, alasan_peminjaman, tanggal_pengajuan, berkas_pendukung) {
            document.getElementById('editLoanRequestId').value = id; // Set ID permintaan              
            document.getElementById('editUser').value = user_id; // Set value Pengguna              
            document.getElementById('editDurasiPeminjaman').value = durasi_peminjaman; // Set value Durasi Peminjaman              
            document.getElementById('editAlasanPeminjaman').value = alasan_peminjaman; // Set value Alasan Peminjaman              
            document.getElementById('editTanggalPengajuan').value = tanggal_pengajuan; // Set value Tanggal Pengajuan              

            // Set action form edit              
            document.getElementById('editForm').action = "{{ route('transaksi-pengajuan.update', '') }}/" + id; // Set action form edit              

            // Tampilkan modal              
            document.getElementById('editModal').classList.remove('hidden');
        }

        let currentDeleteForm = null; // To store the current delete form                

        // Function to show the delete confirmation modal                
        function showDeleteConfirmation(button) {
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
    </script>
</x-lend-layout-template>