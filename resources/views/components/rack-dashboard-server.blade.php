<div class="bg-gray-200 p-6 rounded-lg shadow-md">
    <h1 class="text-xl font-semibold mb-4 text-center">Daftar Perangkat di Setiap Rak</h1>

    <!-- Grid untuk membagi tabel dalam 4 kolom -->
    <div class="grid grid-cols-4 gap-4">
        @foreach ($rackSummary as $rack)
            <div class="bg-white p-4 shadow-md rounded-lg border">
                <h2 class="text-lg font-semibold text-center mb-2">{{ $rack['rack_name'] }}</h2>

                <!-- Wrapper untuk scrolling (tinggi lebih besar) -->
                <div class="overflow-y-auto max-h-96">
                    <table class="w-full border border-gray-300">
                        <thead class="bg-gray-100 sticky top-0">
                            <tr>
                                <th class="border border-gray-300 p-2 text-center">Row</th>
                                <th class="border border-gray-300 p-2 text-center">Device</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rack['rows'] as $rowIndex => $deviceName)
                                <tr>
                                    <td class="border border-gray-300 p-2 text-center">{{ $rowIndex + 1}}</td>
                                    <td class="border border-gray-300 p-2 text-center">{{ $deviceName }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    </div>
</div>