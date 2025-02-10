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

        .info-table,
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .info-table td {
            padding: 5px;
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
            background-color: #28a745;
            color: white;
            font-weight: bold;
            text-align: center;
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

    <table class="info-table">
        <tr>
            <td><strong>No Rak</strong></td>
            <td>: {{ $rack->name }}</td>
            <td><strong>Kapasitas Rak</strong></td>
            <td>: {{ $rack->capacity }}U</td>
        </tr>
        <tr>
            <td><strong>No MCB Power Panel</strong></td>
            <td>: {{ $rack->mcb_power_panel }}</td>
            <td><strong>Kapasitas Power MCB</strong></td>
            <td>: {{ $rack->power_capacity }}</td>
        </tr>
        <tr>
            <td><strong>Jumlah Perangkat</strong></td>
            <td>: {{ $rack->devices_count }}</td>
        </tr>
    </table>

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
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @php $index = 1; @endphp
            @foreach ($groupedAttributes as $rowIndex => $attributes)
            <tr>
                <td>{{ $rowIndex + 1 }}</td>
                <td>{{ optional($attributes->firstWhere('attribute_id', 1))->value ?? '-' }}</td>
                <td>{{ optional($attributes->firstWhere('attribute_id', 2))->value ?? '-' }}</td>
                <td>{{ optional($attributes->firstWhere('attribute_id', 3))->value ?? '-' }}</td>
                <td>{{ optional($attributes->firstWhere('attribute_id', 4))->value ?? '-' }}</td>
                <td>{{ optional($attributes->firstWhere('attribute_id', 5))->value ?? '-' }}</td>
                <td>{{ optional($attributes->firstWhere('attribute_id', 6))->value ?? '-' }}</td>
            </tr>
            @endforeach

        </tbody>
    </table>


</body>

</html>