<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit FAQ - Admin</title>
</head>

<x-lend-layout-template>
    <div>
        <div class="me-7 mt-1">
            @php            
                            $title = 'Daftar Pertanyaan';
                $description = 'Halaman ini berisi daftar pertanyaan yang dapat Anda kelola.';
                $add = 'Tambah Pertanyaan';
                $columns = [
                    ['key' => 'question', 'title' => 'Pertanyaan'],
                    ['key' => 'answer', 'title' => 'Jawaban'],
                ];            
            @endphp        <div id="table"    
                class="relative flex flex-col w-full h-full min-h-[54rem] text-gray-700 bg-[#FFFFFF] border border-gray-900 border-collapse shadow-md rounded-xl bg-clip-border mb-2">
                <div class="relative mx-4 mt-4 overflow-hidden text-gray-700 bg-[#FFFFFF] rounded-none bg-clip-border">
                    <div class="flex items-center justify-between gap-8 mb-4 ms-5 mt-2">
                        <div>
                            <h5
                                class="block font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
                                {{ $title }}
                            </h5>
                            <p
                                class="block mt-1 font-sans text-base antialiased font-normal leading-relaxed text-gray-700">
                                {{ $description }}
                            </p>
                        </div>

                        <div class="flex flex-col gap-2 shrink-0 me-5 sm:flex-row">
                            <div class="w-full md:w-72">
                                <form action="{{ route('faq.index') }}" method="GET"
                                    class="relative h-10 w-full min-w-[200px] bg-white">
                                    <input id="searchInput" name="search"
                                        class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 !pr-9 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-gray-900 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                                        placeholder="Search" value="{{ request('search') }}" />
                                    <button type="submit" class="absolute right-3 top-2.5 text-blue-gray-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z">
                                            </path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                            <button type="button" onclick="openAddModal()"
                                class="flex select-none items-center gap-3 rounded-lg bg-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                <p>{{ $add }}</p>
                            </button>
                        </div>
                    </div>

                    <div class="ms-5 me-5 flex p-6 px-0 -mt-5 overflow-hidden ">
                        <div class="w-full rounded-xl overflow-hidden border border-blue-gray-100">
                            <table id="faqTable" class="w-full mt-4 text-left table-auto">
                                <thead>
                                    <tr>
                                        <th
                                            class="p-4 border-y border-blue-gray-100 bg-blue-gray-50 text-sm font-normal text-blue-gray-900 w-auto text-center">
                                            #
                                        </th>
                                        @foreach ($columns as $column)         <th   
                                                class="p-4 border-y border-blue-gray-100 bg-blue-gray-50 text-sm font-normal text-blue-gray-900 whitespace-normal break-words max-w-[150px]">
                                                {{ $column['title'] }}
                                            </th>
                                        @endforeach
                                        <th
                                            class="p-4 border-y border-blue-gray-100 bg-blue-gray-50 text-sm font-normal text-blue-gray-900 w-auto text-center">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="faqTableBody">
                                    @forelse ($pertanyaans as $pertanyaan)           <tr>   
                                            <td
                                                class="p-4 border-b border-blue-gray-100 text-sm text-blue-gray-900 text-center w-auto">
                                                {{ $pertanyaans->firstItem() + $loop->index }}
                                            </td>
                                            <td
                                                class="p-4 border-b border-blue-gray-100 text-sm text-blue-gray-900 whitespace-normal break-words max-w-[150px]">
                                                {{ $pertanyaan->question }}
                                            </td>
                                            <td
                                                class="p-4 border-b border-blue-gray-100 text-sm text-blue-gray-900 whitespace-normal break-words max-w-[150px]">
                                                {{ $pertanyaan->answer }}
                                            </td>
                                            <td class="border-b border-blue-gray-100">
                                                <div class="flex items-center gap-3 justify-center w-auto">
                                                    <button type="button" class="text-blue-500 flex items-center gap-2"
                                                        onclick="openEditModal('{{ $pertanyaan->id }}', '{{ $pertanyaan->question }}', '{{ $pertanyaan->answer }}')">
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

                                                    <form id="delete-form-{{ $pertanyaan->id }}"
                                                        action="{{ route('edit-faq.destroy', $pertanyaan->id) }}"
                                                        method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button"
                                                            class="text-red-500 flex items-center gap-1 delete-button"
                                                            data-id="{{ $pertanyaan->id }}"
                                                            data-question="{{ $pertanyaan->question }}"
                                                            data-answer="{{ $pertanyaan->answer }}">
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
                                            <td colspan="4" class="p-4 text-center text-sm text-blue-gray-900">
                                                Data FAQ belum Tersedia.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div id="paginasi" class="flex items-center justify-between p-4 border-t border-blue-gray-50">
                        <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                            Total Data: {{ $pertanyaans->total() }} | Page {{ $pertanyaans->currentPage() }} of
                            {{ $pertanyaans->lastPage() }}
                        </p>
                        <div class="flex gap-2 me-2">
                            @if($pertanyaans->onFirstPage())
                                <span
                                    class="select-none rounded-lg border border-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-gray-900 transition-all opacity-50 cursor-not-allowed">
                                    Previous
                                </span>
                            @else
                                <a href="{{ $pertanyaans->previousPageUrl() . (request('search') ? '&search=' . urlencode(request('search')) : '') }}"
                                    class="select-none rounded-lg border border-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-gray-900 transition-all hover:opacity-75">
                                    Previous
                                </a>
                            @endif
                            @if($pertanyaans->hasMorePages())
                                <a href="{{ $pertanyaans->nextPageUrl() . (request('search') ? '&search=' . urlencode(request('search')) : '') }}"
                                    class="select-none rounded-lg border border-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-gray-900 transition-all hover:opacity-75">
                                    Next
                                </a>
                            @else
                                <span
                                    class="select-none rounded-lg border border-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-gray-900 transition-all opacity-50 cursor-not-allowed">
                                    Next
                                </span>
                            @endif
                        </div>
                    </div>

                </div>

                <!-- Modal untuk Tambah Pertanyaan -->
                <div id="addModal"
                    class="fixed inset-0 z-50 hidden bg-gray-800 bg-opacity-50 flex items-center justify-center">
                    <div class="bg-white rounded-lg p-6 w-1/3">
                        <h3 class="text-lg font-bold mb-4">Tambah Pertanyaan Baru</h3>
                        <form id="addForm" action="{{ route('edit-faq.store') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="addQuestion"
                                    class="block text-sm font-medium text-gray-700">Pertanyaan</label>
                                <input type="text" name="question" id="addQuestion"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                    required>
                            </div>

                            <div class="mb-4">
                                <label for="addAnswer" class="block text-sm font-medium text-gray-700">Jawaban</label>
                                <textarea name="answer" id="addAnswer" rows="4"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                    required></textarea>
                            </div>

                            <div class="flex justify-end">
                                <button type="submit"
                                    class="inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Simpan Pertanyaan
                                </button>
                                <button type="button" id="closeAddModal"
                                    class="ml-2 inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-gray-500 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                    Batal
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Modal untuk Edit Pertanyaan -->
                <div id="editModal"
                    class="fixed inset-0 z-50 hidden bg-gray-800 bg-opacity-50 flex items-center justify-center border border-blue-gray-100 border-collapse shadow-md rounded-xl bg-clip-border">
                    <div class="bg-white rounded-lg p-6 w-1/3">
                        <span class="cursor-pointer text-gray-500 float-right" onclick="closeEditModal()">&times;</span>
                        <h3 class="text-lg font-bold mb-4">Edit Pertanyaan</h3>
                        <form id="editForm" action="{{ route('edit-faq.update', '') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT') 
   
                        <input type="hidden" name="id" id="editPertanyaanId"> <!-- Input tersembunyi untuk ID -->

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Pertanyaan</label>
                                <input type="text" name="question" id="editQuestion"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                    required placeholder="Masukkan Pertanyaan">
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Jawaban</label>
                                <textarea name="answer" id="editAnswer" rows="4"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                    required placeholder="Masukkan Jawaban"></textarea>
                            </div>

                            <div class="flex justify-end">
                                <button type="button" class="mr-2 px-4 py-2 bg-gray-300 text-gray-700 rounded-md"
                                    onclick="closeEditModal()">Batal</button>
                                <button type="submit"
                                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Update</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Modal Konfirmasi Penghapusan -->
                <div id="delete-confirmation-modal"
                    class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50 border border-blue-gray-100 border-collapse shadow-md rounded-xl bg-clip-border">
                    <div class="bg-white rounded-lg shadow-lg p-6 w-1/3">
                        <h2 class="text-lg font-semibold mb-4">Konfirmasi Penghapusan</h2>
                        <p>Apakah Anda yakin ingin menghapus item ini?</p>
                        <p id="deleteItemQuestion" class="font-bold"></p>
                        <p id="deleteItemAnswer"></p>
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
        // Menampilkan modal untuk menambah pertanyaan            
        function openAddModal() {
            document.getElementById('addForm').reset(); // Reset form            
            document.getElementById('addModal').classList.remove('hidden'); // Tampilkan modal            
        }

        // Menutup modal untuk menambah pertanyaan            
        document.getElementById('closeAddModal').addEventListener('click', () => {
            document.getElementById('addModal').classList.add('hidden');
        });

        // Menampilkan modal untuk mengedit pertanyaan              
        function openEditModal(id, question, answer) {
            document.getElementById('editPertanyaanId').value = id; // Set ID pertanyaan  
            document.getElementById('editQuestion').value = question; // Set value pertanyaan              
            document.getElementById('editAnswer').value = answer; // Set value jawaban              
            document.getElementById('editForm').action = "{{ route('edit-faq.update', '') }}/" + id; // Set action form edit  
            document.getElementById('editModal').classList.remove('hidden'); // Tampilkan modal              
        }

        // Menutup modal edit              
        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        // Menangani tampilan modal konfirmasi penghapusan            
        const deleteConfirmationModal = document.getElementById('delete-confirmation-modal');
        const cancelDeleteButton = document.getElementById('cancel-delete');
        const confirmDeleteButton = document.getElementById('confirm-delete');
        let currentDeleteForm = null;
        let currentDeleteItemQuestion = '';
        let currentDeleteItemAnswer = '';

        // Fungsi untuk menampilkan modal            
        function showDeleteConfirmation(form, question, answer) {
            currentDeleteForm = form; // Simpan form yang akan dihapus            
            currentDeleteItemQuestion = question; // Simpan pertanyaan yang akan dihapus  
            currentDeleteItemAnswer = answer; // Simpan jawaban yang akan dihapus  
            document.getElementById('deleteItemQuestion').textContent = "Pertanyaan: " + currentDeleteItemQuestion; // Tampilkan pertanyaan  
            document.getElementById('deleteItemAnswer').textContent = "Jawaban: " + currentDeleteItemAnswer; // Tampilkan jawaban  
            deleteConfirmationModal.classList.remove('hidden');
        }

        // Fungsi untuk menyembunyikan modal            
        function hideDeleteConfirmation() {
            deleteConfirmationModal.classList.add('hidden');
        }

        // Event listener untuk tombol hapus            
        document.querySelectorAll('.delete-button').forEach(button => {
            button.addEventListener('click', function () {
                const formId = `delete-form-${this.dataset.id}`; // Ambil ID form dari data attribute            
                const form = document.getElementById(formId);
                const question = this.dataset.question; // Ambil pertanyaan dari data attribute  
                const answer = this.dataset.answer; // Ambil jawaban dari data attribute  
                showDeleteConfirmation(form, question, answer);
            });
        });

        // Event listener untuk tombol batal            
        cancelDeleteButton.addEventListener('click', hideDeleteConfirmation);

        // Event listener untuk tombol konfirmasi hapus            
        confirmDeleteButton.addEventListener('click', function () {
            if (currentDeleteForm) {
                currentDeleteForm.submit(); // Kirim form yang telah disimpan            
            }
            hideDeleteConfirmation();
        });

        // Fungsi untuk memfilter tabel berdasarkan input pencarian            
        function filterTable() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const rows = document.querySelectorAll('#faqTableBody tr');
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