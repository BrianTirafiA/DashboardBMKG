<x-layout-server>
    <h2 class="text-2xl font-semibold">Laporan Detail Rak: {{ $rack->name }}</h2>
    <p>Ini adalah laporan detail untuk rak <strong>{{ $rack->name }}</strong>.</p>

    <!-- Tombol Cetak -->
    <div class="my-4">
        <a href="{{ route('rack.report.print', ['rackId' => $rack->id]) }}" 
           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Cetak Laporan
        </a>

        <a href="{{ route('rack.report.download', ['rackId' => $rack->id]) }}" 
           class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
            Download PDF
        </a>
    </div>

    <!-- Tampilkan laporan -->
    <table class="data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Perangkat</th>
                <th>Jenis</th>
                <th>Tahun</th>
                <th>Merek</th>
                <th>PDU</th>
                <th>Daya</th>
                <th>User</th>
                <th>Fungsi</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($formattedData as $row)
                <tr>
                    <td>{{ $row['No'] }}</td>
                    <td>{{ $row['Perangkat'] ?? '-' }}</td>
                    <td>{{ $row['Jenis'] ?? '-' }}</td>
                    <td>{{ $row['Tahun'] ?? '-' }}</td>
                    <td>{{ $row['Merek'] ?? '-' }}</td>
                    <td>{{ $row['PDU'] ?? '-' }}</td>
                    <td>{{ $row['Daya'] ?? '-' }}</td>
                    <td>{{ $row['User'] ?? '-' }}</td>
                    <td>{{ $row['Fungsi'] ?? '-' }}</td>
                    <td class="status-operasional">{{ $row['Keterangan'] ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-layout-server>
