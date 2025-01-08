<!-- resources/views/your-view.blade.php -->
<x-layout-server>
  <h2 class="text-2xl font-semibold">Dashboard : Ruang Server</h2>
  <p>Ini adalah konten utama halaman. Anda dapat menambahkan lebih banyak informasi di sini.</p>
  <!-- Tambahkan konten lainnya di sini -->

  <div class="grid grid-cols-3 gap-6 mt-8 px-6">
    <x-progress-bar title="Rak A" :percentage="80" />
    <x-progress-bar title="Rak B" :percentage="80" />
    <x-progress-bar title="Rak C" :percentage="34" />
    <x-progress-bar title="Rak D" :percentage="80" />
    <x-progress-bar title="Rak E" :percentage="80" />
    <x-progress-bar title="Rak F" :percentage="80" />
  </div>



</x-layout-server>