<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan - Admin</title>
</head>

<x-lend-layout-template>
    <div>
        <div class="me-7 mt-1">
            @php      
                $title = 'Laporan';
                $description = 'Halaman ini berisi Laporan yang dapat Anda kelola.';
                $columns = [
                    ['key' => 'id', 'title' => 'ID'],
                    ['key' => 'user.name', 'title' => 'Nama Pemohon'],
                    ['key' => 'durasi_peminjaman', 'title' => 'Durasi (Hari)'],
                    ['key' => 'approval_status', 'title' => 'Status'],
                    ['key' => 'tanggal_pengajuan', 'title' => 'Tanggal Pengajuan'],
                    ['key' => 'approval_date', 'title' => 'Tanggal Diterima'],
                    ['key' => 'returned_date', 'title' => 'Tanggal Pengembalian'],
                    ['key' => 'admin.name', 'title' => 'Admin Penerima'],
                    ['key' => 'items', 'title' => 'Item (Jumlah)'],
                ];      
            @endphp      

            <div id="table" class="relative flex flex-col w-full h-full min-h-[54rem] text-gray-700 bg-white border border-gray-900 shadow-md rounded-xl mb-2">
                <div class="relative mx-4 mt-4 overflow-hidden text-gray-700 bg-white rounded-none">
                <div class="flex items-center justify-between gap-8 mb-4 ms-5 mt-2">
    <div>
        <h5 class="block font-sans text-xl font-semibold leading-snug tracking-normal text-blue-gray-900">
            {{ $title }}
        </h5>
        <p class="block mt-1 font-sans text-base font-normal leading-relaxed text-gray-700">
            {{ $description }}
        </p>
    </div>

    <div class="flex flex-col gap-2 shrink-0 me-5 sm:flex-row">
        <!-- Search Form -->
        <div class="w-full md:w-64">
            <form action="{{ route('report.index') }}" method="GET" class="relative h-10 w-full min-w-[200px] bg-white">
                <input id="searchInput" name="search" 
                    class="peer h-full w-full rounded-[7px] border border-blue-gray-200 bg-transparent px-3 py-2.5 text-sm text-blue-gray-700 outline-none transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 focus:border-2 focus:border-gray-900" 
                    placeholder="Search" value="{{ request('search') }}" />
                <button type="submit" class="absolute right-3 top-2.5 text-blue-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"></path>
                    </svg>
                </button>
            </form>
        </div>

        <!-- Filter Form -->
        <div class="relative flex items-center">
            <div class="absolute left-3 top-1/2 transform -translate-y-1/2 pointer-events-none -mt-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar3" viewBox="0 0 16 16">
                    <path d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2M1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857z"></path>
                    <path d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2"></path>
                </svg>
            </div>
            <form action="{{ route('report.index') }}" method="GET" class="flex items-center mb-4">
                <select name="periode" id="periode" onchange="this.form.submit()" class="w-full text-sm text-gray-800 border border-gray-300 px-10 py-2 rounded-md outline-blue-600 appearance-none">
                    <option value="">Semua Periode Pengajuan</option>
                    <option value="sepekan" {{ request('periode') == 'sepekan' ? 'selected' : '' }}>Sepekan Terakhir</option>
                    <option value="bulanan" {{ request('periode') == 'bulanan' ? 'selected' : '' }}>Bulanan Terakhir</option>
                    <option value="triwulan" {{ request('periode') == 'triwulan' ? 'selected' : '' }}>Triwulan Terakhir</option>
                    <option value="semester" {{ request('periode') == 'semester' ? 'selected' : '' }}>Semester Terakhir</option>
                    <option value="tahunan" {{ request('periode') == 'tahunan' ? 'selected' : '' }}>Satu Tahun Terakhir</option>
                </select>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down -ms-7 mt-1" viewBox="0 0 16 16">
                        <path d="M3.204 5h9.592L8 10.481zm-.753.659 4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659"></path>
                    </svg>
                </div>
            </form>
        </div>

        <!-- Print Button -->
        <a href="{{ route('laporan.cetak', ['periode' => request('periode'), 'search' => request('search')]) }}" class="flex items-center gap-3 rounded-lg bg-gray-900 py-2 px-4 text-xs font-bold uppercase text-white shadow-md transition-all hover:shadow-lg h-10 flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1"/>
                <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1"/>
            </svg>
            Cetak Laporan
        </a>
    </div>
</div>


                    <div class="ms-5 me-5 flex p-6 px-0 -mt-5 overflow-hidden">
                        <div class="w-full rounded-xl overflow-hidden border border-blue-gray-100">
                            <table id="usertable" class="w-full mt-4 text-left table-auto">
                                <thead>
                                    <tr>
                                        <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50 text-sm font-normal text-blue-gray-900 text-center">#</th>
                                        @foreach ($columns as $column)
                                            <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50 text-sm font-normal text-blue-gray-900 whitespace-normal break-words max-w-[150px]">
                                                {{ $column['title'] }}
                                            </th>
                                        @endforeach
                                        <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50 text-sm font-normal text-blue-gray-900 text-center">Actions</th>
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
                                                        <p class="cursor-pointer">
                                                            {{ $loanRequest->user ? $loanRequest->user->fullname : '-' }}
                                                        </p>
                                                    @elseif ($column['key'] === 'admin.name')
                                                        <p class="cursor-pointer">
                                                            {{ $loanRequest->admin ? $loanRequest->admin->fullname : '-' }}
                                                        </p>
                                                    @elseif ($column['key'] === 'items')
                                                        <ul>
                                                            @foreach ($loanRequest->items as $item)
                                                                <li>{{ $item->itemDetail ? $item->itemDetail->nama_item : 'Item tidak ditemukan' }} ({{ $item->quantity }})</li>
                                                            @endforeach
                                                        </ul>
                                                    @else
                                                        {{ $loanRequest->{$column['key']} }}
                                                    @endif
                                                </td>
                                            @endforeach
                                            <td class="border-b border-blue-gray-100">
                                                <div class="flex items-center gap-3 justify-center">
                                                    <button type="button" class="text-blue-500 flex items-center gap-2" onclick="openDetailModal('{{ $loanRequest->id }}', '{{ $loanRequest->user->fullname }}', '{{ $loanRequest->user->email }}', '{{ $loanRequest->user->nip }}', '{{ $loanRequest->user->no_telepon }}', '{{ $loanRequest->user->unit_kerja ? $loanRequest->user->unit_kerja->nama_unit_kerja : 'Unit Kerja Pemohon Tidak Tersedia' }}', '{{ $loanRequest->user->profile_photo }}', '{{ $loanRequest->durasi_peminjaman }}', '{{ $loanRequest->alasan_peminjaman }}', '{{ $loanRequest->tanggal_pengajuan }}', '{{ $loanRequest->berkas_pendukung }}', '{{ $loanRequest->items->map(function ($item) { return $item->itemDetail ? $item->itemDetail->nama_item : 'Item tidak ditemukan'; })->join(', ') }}')">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                                        </svg>
                                                        Detail
                                                    </button>
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
                            Total Data: {{ $loan_requests->total() }} | Page {{ $loan_requests->currentPage() }} of {{ $loan_requests->lastPage() }}
                        </p>
                        <div class="flex gap-2 me-2">
                            @php
                                // Ambil semua query parameter, kecuali 'page'
                                $queryParams = request()->query();
                                unset($queryParams['page']); // Hindari duplikasi 'page'

                                // Buat query string baru tanpa parameter 'page'
                                $queryString = $queryParams ? '&' . http_build_query($queryParams) : '';

                                // Tambahkan query string ke URL pagination
                                $prevUrl = $loan_requests->previousPageUrl() . $queryString;
                                $nextUrl = $loan_requests->nextPageUrl() . $queryString;
                            @endphp

                            @if($loan_requests->onFirstPage())
                                <span class="select-none rounded-lg border border-gray-900 py-2 px-4 text-center font-sans text-xs font-bold uppercase text-gray-900 transition-all opacity-50 cursor-not-allowed">Previous</span>
                            @else
                                <a href="{{ $prevUrl }}" class="select-none rounded-lg border border-gray-900 py-2 px-4 text-center font-sans text-xs font-bold uppercase text-gray-900 transition-all hover:opacity-75">Previous</a>
                            @endif

                            @if($loan_requests->hasMorePages())
                                <a href="{{ $nextUrl }}" class="select-none rounded-lg border border-gray-900 py-2 px-4 text-center font-sans text-xs font-bold uppercase text-gray-900 transition-all hover:opacity-75">Next</a>
                            @else
                                <span class="select-none rounded-lg border border-gray-900 py-2 px-4 text-center font-sans text-xs font-bold uppercase text-gray-900 transition-all opacity-50 cursor-not-allowed">Next</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk Menampilkan Detail Permohonan -->
    <div id="requestModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-lg p-6 w-1/2">
            <div class="text-center">
                <h2 class="text-lg font-semibold">Detail Permohonan</h2>
                <p><strong>ID:</strong> <span id="modalRequestId"></span></p>
            </div>

            <div class="flex w-full space-x-5">
                <div class="flex-row w-full">
                    <h2 class="text-md font-semibold mb-5">Detail Pemohon</h2>
                    <div class="flex space-x-5">
                        <div>
                            <div class="text-center">
                                <img id="modalProfilePhoto" src=" " alt="Profile Photo" class="w-36 h-36 border border-gray-300 p-2 rounded-2xl mx-auto">
                            </div>
                        </div>
                        <div class="w-full">
                            <div class="mb-1">
                                <label for="modalNamaPemohon" class="block text-sm font-medium text-gray-700 mb-1">Nama Pemohon</label>
                                <span id="modalNamaPemohon" class="block w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-md bg-gray-100"></span>
                            </div>
                            <div class="mb-4">
                                <label for="modalEmailPemohon" class="block text-sm font-medium text-gray-700 mb-1">Email Pemohon</label>
                                <span id="modalEmailPemohon" class="block w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-md bg-gray-100"></span>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="modalNIP" class="block text-sm font-medium text-gray-700 mb-2">Nomor Induk Pegawai</label>
                        <span id="modalNIP" class="block w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-md bg-gray-100"></span>
                    </div>
                    <div class="mb-4">
                        <label for="modalTelepon" class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                        <span id="modalTelepon" class="block w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-md bg-gray-100"></span>
                    </div>
                    <div class="mb-4">
                        <label for="modalDepartemen" class="block text-sm font-medium text-gray-700 mb-2">Unit Kerja</label>
                        <span id="modalDepartemen" class="block w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-md bg-gray-100"></span>
                    </div>
                </div>

                <div class="flex-row w-full">
                    <h2 class="text-md font-semibold mb-5">Detail Permintaan</h2>
                    <div class="mb-1">
                        <label for="modalLoanDuration" class="block text-sm font-medium text-gray-700 mb-1">Durasi Peminjaman</label>
                        <span id="modalLoanDuration" class="block w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-md bg-gray-100"></span>
                    </div>
                    <div class="mb-4">
                        <label for="modalLoanReason" class="block text-sm font-medium text-gray-700 mb-1">Alasan Peminjaman</label>
                        <span id="modalLoanReason" class="block w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-md bg-gray-100"></span>
                    </div>
                    <div class="mb-4">
                        <label for="modalSubmissionDate" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Pengajuan</label>
                        <span id="modalSubmissionDate" class="block w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-md bg-gray-100"></span>
                    </div>
                    <div class="mb-4">
                        <label for="modalReturnDate" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Pengembalian (Jika Disetujui)</label>
                        <span id="modalReturnDate" class="block w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-md bg-gray-100"></span>
                    </div>

                    <div class="mb-4">
                        <label for="modalItems" class="block text-sm font-medium text-gray-700 mb-2">Items</label>
                        <span id="modalItems" class="block w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-md bg-gray-100"></span>
                    </div>
                </div>

                <div class="w-full">
                    <h2 class="text-md font-semibold mb-4">Berkas Pendukung</h2>
                    <div class="mb-4">
                        <label for="modalSupportingDocuments" class="block text-sm font-medium text-gray-700 mb-2">Berkas Pendukung</label>
                        <span id="modalSupportingDocuments" class="block w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-md bg-gray-100"></span>
                    </div>
                </div>
            </div>

            <div class="flex justify-end mt-4">
                <button id="closeRequestModal" onclick="closeRequestModal()" class="bg-blue-500 text-white px-4 py-2 rounded">Tutup</button>
            </div>
        </div>
    </div>

    <script>
    function printReport() {
        const periode = document.getElementById('periode').value;
        const url = `{{ route('laporan.cetak') }}?periode=${periode}`;
        window.location.href = url;
    }
</script>

    <script>
        function openDetailModal(id, fullname, email, nip, no_telepon, unit_kerja, profile_photo, loanDuration, loanReason, submissionDate, returnDate, supportingDocuments, items) {
            document.getElementById('modalRequestId').textContent = id;
            document.getElementById('modalNamaPemohon').textContent = fullname ? fullname : "Nama Lengkap Pemohon Tidak Ada";
            document.getElementById('modalEmailPemohon').textContent = email ? email : "Email Pemohon Tidak Ada";
            document.getElementById('modalNIP').textContent = nip ? nip : "Nomor Induk Pegawai Pemohon Tidak Ada";
            document.getElementById('modalTelepon').textContent = no_telepon ? no_telepon : "Nomor Telepon Pemohon Tidak Ada";
            document.getElementById('modalDepartemen').textContent = unit_kerja ? unit_kerja : "Unit Kerja Pemohon Tidak Ada";
            document.getElementById('modalProfilePhoto').src = profile_photo || 'default-profile.png'; // Ganti dengan gambar default jika tidak ada
            document.getElementById('modalLoanDuration').textContent = loanDuration;
            document.getElementById('modalLoanReason').textContent = loanReason ? loanReason : "Detail Alasan Tidak Tersedia";
            document.getElementById('modalSubmissionDate').textContent = submissionDate;
            document.getElementById('modalReturnDate').textContent = returnDate || "Belum Kembali";
            document.getElementById('modalSupportingDocuments').textContent = supportingDocuments ? supportingDocuments : "Dokumen Tidak Tersedia";
            document.getElementById('modalItems').textContent = items;

            // Tampilkan modal  
            document.getElementById('requestModal').classList.remove('hidden');
        }

        function closeRequestModal() {
            document.getElementById('requestModal').classList.add('hidden');
        }
    </script>

</x-lend-layout-template>
</html>
