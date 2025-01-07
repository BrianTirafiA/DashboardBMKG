<!-- resources/views/your-view.blade.php -->
<x-layout-server>
  <h2 class="text-2xl font-semibold">Konten Utama Elhanif</h2>
  <p>Ini adalah konten utama halaman. Anda dapat menambahkan lebih banyak informasi di sini.</p>
  <!-- Tambahkan konten lainnya di sini -->

  <div class="flex space-x-6">
    <!-- Panggil Komponen Rak -->
    <x-rack-table />
    <x-rack-table />
    <x-rack-table />
  </div>
</x-layout-server>