<x-layout-server>
  <h2 class="text-2xl font-semibold mb-4">Dashboard : Ruang Server</h2>
  <p class="mb-8 text-gray-700">Ini adalah konten utama halaman. Anda dapat menambahkan lebih banyak informasi di sini.
  </p>

  <div class="space-y-10">
    <!-- Distribusi Kapasitas Rak Server -->
    <div class="bg-gray-200 py-6 px-8 rounded-lg shadow-md">
      <h1 class="text-xl font-semibold mb-6 text-center">Distribusi Kapasitas Rak Server</h1>
      <div class="grid grid-cols-3 gap-8">
        @foreach ($rackData as $rack)
      <x-progress-bar title="{{ $rack['name'] }}" :filled="$rack['filled']" :total="$rack['total']" />
    @endforeach
      </div>
    </div>

    <!-- Wrapper Flexbox agar Pie Chart dan Rak Panel bersampingan -->
    <div class="flex gap-10">
      <!-- Pie Chart -->
      <div class="w-1/2 bg-gray-200 p-6 shadow-md rounded-lg">
        <h1 class="text-xl font-semibold mb-6 text-center">Distribusi Status Rak</h1>
        <x-pie-chart-server title="Distribusi Status Rak" :percentages="$percentages" :colors="$colors"
          :labels="$labels" />
      </div>

      <!-- Distribusi Kapasitas Rak Panel (dengan Scroll) -->
      <div class="w-1/2 bg-gray-200 p-6 shadow-md rounded-lg">
        <h1 class="text-xl font-semibold mb-4 text-center">Distribusi Kapasitas Rak Panel</h1>
        <div class="overflow-y-auto max-h-[500px] pr-3">
          <div class="grid grid-cols-2 gap-6">
            @foreach ($rackPanelData as $rack)
        <x-progress-bar title="{{ $rack['name'] }}" :filled="$rack['filled']" :total="$rack['total']" />
      @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Ringkasan Rack -->
  <div class="mt-10">
    <x-rack-dashboard-server :rackSummary="$rackSummary" />
  </div>
</x-layout-server>