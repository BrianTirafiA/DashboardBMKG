<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Rack Attributes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            width: 80px;
        }

        .header h1,
        .header h2,
        .header h3,
        .header p {
            margin: 3px 0;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .data-table th,
        .data-table td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        .data-table th {
            background-color: #f0f0f0;
            text-align: center;
        }

        .status-operasional {
            text-align: center;
            font-weight: bold;
        }

        .status-beroperasi {
            background-color: #28a745;
            color: white;
        }

        .status-standby {
            background-color: #ffc107;
            color: black;
        }

        .status-tidak-beroperasi {
            background-color: #dc3545;
            color: white;
        }
    </style>
</head>

<body>

    <div class="header">
        <img src="{{ asset('assets/logo-bmkg.png') }}" alt="Logo BMKG">
        <h1>BADAN METEOROLOGI, KLIMATOLOGI, DAN GEOFISIKA</h1>
        <h2>PUSAT DATABASE</h2>
        <h3>SUB KOORDINATOR PEMELIHARAAN DATABASE UMUM</h3>
        <p>Update: {{ now()->format('d F Y') }}</p>
    </div>

    <!-- Tambahan Nama Rak -->
    <p><strong>Nama Rak:</strong> {{ $rack->name }}</p>

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
                        @php
                            // Tentukan warna background berdasarkan status operasional
                            $statusClass = '';
                            if ($row['Keterangan'] === 'Beroperasi') {
                                $statusClass = 'status-beroperasi';
                            } elseif ($row['Keterangan'] === 'Stand By') {
                                $statusClass = 'status-standby';
                            } elseif ($row['Keterangan'] === 'Tidak Beroperasi') {
                                $statusClass = 'status-tidak-beroperasi';
                            }
                        @endphp

                        <tr>
                            <td style="text-align: center;">{{ $row['No'] }}</td>
                            <td>{{ $row['Perangkat'] ?? '-' }}</td>
                            <td>{{ $row['Jenis'] ?? '-' }}</td>
                            <td>{{ $row['Tahun'] ?? '-' }}</td>
                            <td>{{ $row['Merek'] ?? '-' }}</td>
                            <td>{{ $row['PDU'] ?? '-' }}</td>
                            <td>{{ $row['Daya'] ?? '-' }}</td>
                            <td>{{ $row['User'] ?? '-' }}</td>
                            <td>{{ $row['Fungsi'] ?? '-' }}</td>
                            <td class="status-operasional {{ $statusClass }}">{{ $row['Keterangan'] ?? '-' }}</td>
                        </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>