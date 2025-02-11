<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Server Room : Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<x-layout-server>
  <h2 class="text-2xl font-semibold mb-4">Dashboard : Ruang Server</h2>
  </p>
  <div class="max-h-[47rem] overflow-y-scroll p-4 bg-white shadow-xl rounded-xl border border-blue-gray-900 scrollbar-thumb-rounded-full scrollbar-track-rounded-full scrollbar scrollbar-thumb-slate-700 scrollbar-track-slate-300 mb-6">

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
      <div class="flex w-full gap-6">
        <!-- Distribusi Status Rak -->
        <div class="w-1/2 bg-gray-200 p-6 shadow-md rounded-lg h-full flex flex-col">
          <h1 class="text-xl font-semibold mb-6 text-center">Distribusi Status Rak</h1>
          <div class="flex-grow">
            <x-pie-chart-server title="Distribusi Status Rak" :percentages="$percentages" :colors="$colors"
              :labels="$labels" />
          </div>
        </div>

        <!-- Distribusi Kapasitas Rak Panel -->
        <div class="w-1/2 bg-gray-200 p-6 shadow-lg rounded-lg h-full flex flex-col">
          <h1 class="text-xl font-semibold mb-4 text-center">Distribusi Kapasitas Rak Panel</h1>
          <div class="overflow-y-auto pr-3 flex-grow">
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
  </div>
</x-layout-server>