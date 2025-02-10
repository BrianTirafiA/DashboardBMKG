<x-layout-server>
    <h2 class="text-2xl font-semibold mb-4 text-center">Laporan Semua Rak</h2>

    <!-- Container dengan scroll -->
    <div class="max-h-[400px] overflow-y-auto p-3 border border-gray-300 rounded-lg">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach ($racks as $rack)
                <div class="bg-gray-100 p-5 rounded-lg shadow-md text-center flex flex-col items-center">
                    <h3 class="font-semibold text-lg mb-3">{{ $rack->name }}</h3>

                    <div class="flex flex-col gap-3 w-full items-center">
                        <a href="{{ route('rack.report.show', $rack->id) }}"
                            class="bg-blue-500 hover:bg-blue-700 text-white text-sm font-bold py-2 px-5 rounded w-1/2">
                            Lihat Laporan
                        </a>

                        <a href="{{ route('rack.report.download', $rack->id) }}"
                            class="bg-green-500 hover:bg-green-700 text-white text-sm font-bold py-2 px-5 rounded w-1/2">
                            Download Laporan
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layout-server>
