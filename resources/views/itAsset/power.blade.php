<!-- resources/views/your-view.blade.php -->
<x-layout-server>
    <h2 class="text-2xl font-semibold">Power d</h2>
    <p>Ini adalah konten utama halaman. Anda dapat menambahkan lebih banyak informasi di sini.</p>
    <!-- Tambahkan konten lainnya di sini -->
    <div class="overflow-x-auto">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">

            <!-- Grid untuk menampilkan beberapa tabel secara berdampingan -->
            <x-table-panel />
            <x-table-panel />
            <x-table-panel />
            <x-table-panel />
            <x-table-panel />
            <x-table-panel />
            
        </div>
    </div>
</x-layout-server>