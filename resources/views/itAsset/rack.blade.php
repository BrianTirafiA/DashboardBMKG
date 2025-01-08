<!-- resources/views/your-view.blade.php -->
<x-layout-server>
  <h2 class="text-2xl font-semibold">Konten Utama Elhanif</h2>
  <p>Ini adalah konten utama halaman. Anda dapat menambahkan lebih banyak informasi di sini.</p>
  <!-- Tambahkan konten lainnya di sini -->

  <div class="flex w-full h-screen overflow-y-auto">
    <!-- Panggil Komponen Rak -->
    <x-rack-table class="flex-1 border rounded-lg" />
    <x-rack-table class="flex-1 border rounded-lg" />
    <x-rack-table class="flex-1 border rounded-lg" />
  </div>


</x-layout-server>