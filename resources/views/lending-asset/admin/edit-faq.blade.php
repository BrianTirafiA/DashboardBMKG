<x-lend-layout-template>  
    <div class="">  
        <div class="me-7 mb-9 mt-1">  
            @php  
            // Data yang didefinisikan langsung di Blade
                $title = 'Daftar Pertanyaan';
                $description = 'Halaman ini berisi daftar pertanyaan yang dapat Anda kelola.';
                $add = 'Tambah Pertanyaan';
                
                // Jika tidak ada data, gunakan data default  
                $data = $pertanyaans->isEmpty() ? [] : $pertanyaans;  
  
                // Definisikan kolom  
                $columns = [  
                    ['key' => 'question', 'title' => 'Pertanyaan'],  
                    ['key' => 'answer', 'title' => 'Jawaban'],   
                ];  

                
            @endphp  
  
            <!-- <data-dinamis
            :title="'Edit Frequently Asked Questions.'" 
            :description="'Halaman untuk mengedit FAQ. Masukkan pertanyaan dan jawaban, serta lihat tampilan pada pengguna'" 
            :add="'Tambah Pertanyaan'"/>   -->

            <div id="table" class="relative flex flex-col w-full h-full text-gray-700 bg-[#FFFFFF] border border-blue-gray-100 border-collapse shadow-md rounded-xl bg-clip-border">
                <div class="relative mx-4 mt-4 overflow-hidden text-gray-700 bg-[#FFFFFF] rounded-none bg-clip-border">
                    <div class="flex items-center justify-between gap-8 mb-8 ms-2 mt-2">
                        <div>
                            <h5 class="block font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
                                {{ $title }}
                            </h5>
                            <p class="block mt-1 font-sans text-base antialiased font-normal leading-relaxed text-gray-700">
                                {{ $description }}
                            </p>
                        </div>
                        <div class="flex flex-col gap-2 shrink-0 sm:flex-row">
                            <!-- <button type="button" class="select-none rounded-lg border border-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-gray-900 transition-all hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                view all
                            </button> -->
                            <button type="button" class="flex select-none items-center gap-3 rounded-lg bg-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                <p>{{ $add }}</p>
                            </button>
                        </div>
                    </div>
                    <div id='kategori' class="flex flex-col items-center justify-between gap-4 md:flex-row">
                        
                        <div class="w-full md:w-72">
                            <div class="relative h-10 w-full min-w-[200px] bg-white">
                                <div class="absolute grid w-5 h-5 top-2/4 right-3 -translate-y-2/4 place-items-center text-blue-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"></path>
                                    </svg>
                                </div>
                                <input class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 !pr-9 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-gray-900 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50" placeholder=" " />
                                <label class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none !overflow-visible truncate text-[11px] font-normal leading-tight text-gray-500 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:!border-gray-900 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:!border-gray-900 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                                    Search
                                </label>
                            </div>
                        </div>
                        <div class="w-full md:w-72">
                            <select class="h-10 w-full rounded-md border border-blue-gray-200 bg-white px-3">
                                <option value="5">5 rows</option>
                                <option value="10">10 rows</option>
                                <option value="15">15 rows</option>
                                <option value="20">20 rows</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="ms-5 me-5 flex p-6 px-0 overflow-hidden ">
                    <div class="w-full rounded-xl overflow-hidden border border-blue-gray-100">
                        <table class="w-full mt-4 text-left table-auto">
                            <thead>
                            <tr>
                                <!-- Kolom Number -->
                                <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50 text-sm font-normal text-blue-gray-900 w-auto text-center">
                                    #
                                </th>
                                <!-- Kolom Data -->
                                @foreach ($columns as $column)
                                    <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50 text-sm font-normal text-blue-gray-900 whitespace-normal break-words max-w-[150px]">
                                        {{ $column['title'] }}
                                    </th>
                                @endforeach
                                <!-- Kolom Actions -->
                                <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50 text-sm font-normal text-blue-gray-900 w-auto text-center">
                                    Actions
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($data as $index => $row)
                                <tr>
                                    <!-- Nomor -->
                                    <td class="p-4 border-b border-blue-gray-100 text-sm text-blue-gray-900 text-center w-auto">
                                        {{ $index + 1 }}
                                    </td>
                                    <!-- Kolom Data -->
                                    @foreach ($columns as $column)
                                        <td class="p-4 border-b border-blue-gray-100 text-sm text-blue-gray-900 whitespace-normal break-words max-w-[150px]">
                                            {{ $row[$column['key']] }}
                                        </td>
                                    @endforeach
                                    <!-- Actions -->
                                    <td class=" border-b border-blue-gray-100 ">
                                        <div class="flex items-center gap-2 justify-center w-auto">
                                            <button class="text-blue-500 flex items-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                                </svg>
                                                Edit
                                            </button>
                                            <button class="text-red-500 flex items-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                                                </svg>
                                                Delete
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{ count($columns) + 2 }}" class="p-4 text-center text-sm text-blue-gray-900">
                                        No data available
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>


                    </div>
                </div>

                <div class="flex items-center justify-between p-4 border-t border-blue-gray-50">
                    <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                        Page 1 of 10
                    </p>
                    <div class="flex gap-2">
                        <button class="select-none rounded-lg border border-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-gray-900 transition-all hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="button">
                            Previous
                        </button>
                        <button class="select-none rounded-lg border border-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-gray-900 transition-all hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="button">
                            Next
                        </button>
                    </div>
                </div>
            </div>
            
  
            <!-- Modal untuk Create/Edit -->  
            <div id="faqModal" class="fixed inset-0 z-50 hidden bg-gray-800 bg-opacity-50 flex items-center justify-center">  
                <div class="bg-white rounded-lg p-6 w-1/3">  
                    <h3 class="text-lg font-bold mb-4" id="modalTitle">Tambah Pertanyaan Baru</h3>  
                    <form id="faqForm" action="{{ route('faq.store') }}" method="POST">  
                        @csrf  
                        <input type="hidden" name="_method" id="method" value="POST">  
                        <div class="mb-4">  
                            <label for="question" class="block text-sm font-medium text-gray-700">Pertanyaan</label>  
                            <input type="text" name="question" id="question" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>  
                        </div>  
  
                        <div class="mb-4">  
                            <label for="answer" class="block text-sm font-medium text-gray-700">Jawaban</label>  
                            <textarea name="answer" id="answer" rows="4" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required></textarea>  
                        </div>  
  
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">  
                            Simpan Pertanyaan  
                        </button>  
                        <button type="button" id="closeModal" class="mt-2 text-gray-500 hover:text-gray-700">Cancel</button>  
                    </form>  
                </div>  
            </div>  
        </div>  
    </div>  
  
    <script>  
        // Menampilkan modal untuk menambah pertanyaan  
        function openModal() {  
            document.getElementById('faqForm').reset(); // Reset form  
            document.getElementById('modalTitle').innerText = 'Tambah Pertanyaan Baru'; // Set title modal  
            document.getElementById('method').value = 'POST'; // Set method POST  
            document.getElementById('faqModal').classList.remove('hidden'); // Tampilkan modal  
        }  
  
        // Menampilkan modal untuk mengedit pertanyaan  
        function openEditModal(id, question, answer) {  
            document.getElementById('faqForm').action = '/admin/faq/update/' + id; // Set action form  
            document.getElementById('question').value = question; // Set value pertanyaan  
            document.getElementById('answer').value = answer; // Set value jawaban  
            document.getElementById('modalTitle').innerText = 'Edit Pertanyaan'; // Set title modal  
            document.getElementById('method').value = 'POST'; // Set method POST  
            document.getElementById('faqModal').classList.remove('hidden'); // Tampilkan modal  
        }  
  
        // Menutup modal  
        document.getElementById('closeModal').addEventListener('click', () => {  
            document.getElementById('faqModal').classList.add('hidden');  
        });  
    </script>  
</x-lend-layout-template>  
