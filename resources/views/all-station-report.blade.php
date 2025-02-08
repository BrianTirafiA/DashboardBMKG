<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Stations Report</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
        }
        .header {
            margin-bottom: 20px;
            background-color: #f0f0f0;
            padding: 20px;
            border-bottom: 2px solid #000;
        }
        .header-table {
            width: 100%;
            border-collapse: collapse;
            border: none;
        }
        .header-table td {
            vertical-align: middle;
            padding: 10px;
            border: none;
        }
        .logo-container {
            width: 80px;
            text-align: center;
        }
        .logo {
            width: 70px;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border: 1px solid black;
        }
        table th, table td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        .chart-container {
            text-align: center;
            margin-top: 20px;
        }
        .table-title {
            font-size: 16px;
            margin-top: 20px;
            font-weight: bold;
        }
        .header-info {
            text-align: left;
        }
        .header-info h1 {
            margin: 0;
            font-size: 19px;
        }
    </style>
</head>

<body>
    <div class="header">
        <table class="header-table">
            <tr>
                <td class="logo-container">
                    <img src="/public/assets/logo-bmkg.png" alt="Logo BMKG" class="logo">
                </td>
                <td class="header-info">
                    <h1>BADAN METEOROLOGI, KLIMATOLOGI, DAN GEOFISIKA</h1>
                    <h2 style="font-weight: bold;">DIREKTORAT DATA DAN KOMPUTASI</h2>
                    <h3>Jl. Angkasa I No. 2, Jakarta 10610 Telp: (021) 4246321</h3>
                </td>
            </tr>
        </table>
    </div>

    @foreach ($reportData as $data)
        <h2><strong>{{ $data['stationName'] }}</strong></h2>

        <h3 class="table-title">Detail Persentase Pembacaan Flagging</h3>
        <table>
            <thead>
                <tr>
                    <th>Kategori</th>
                    <th>Tanggal</th>
                    <th>Persentase</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data['validData'] as $date => $value)
                    <tr>
                        <td style="background-color: #006d7e;">Valid</td>
                        <td>{{ $date }}</td>
                        <td>{{ $value }}%</td>
                    </tr>
                @endforeach

                @foreach ($data['invalidData'] as $date => $flags)
                    @foreach ($flags as $flagNumber => $flagValue)
                        <tr>
                            <td style="background-color: #f7c92e;">Invalid - Flag {{ $flagNumber }}</td>
                            <td>{{ $date }}</td>
                            <td>{{ $flagValue }}%</td>
                        </tr>
                    @endforeach
                @endforeach

                @foreach ($data['missingData'] as $date => $value)
                    <tr>
                        <td style="background-color: #b12629;">Missing</td>
                        <td>{{ $date }}</td>
                        <td>{{ $value }}%</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="chart-container">
            <h3>Chart: {{ $data['stationName'] }}</h3>
            <img src="{{ $data['chartImage'] }}" alt="Chart Image" style="width: 100%; max-width: 800px;">
        </div>

        <hr>
    @endforeach
</body>

</html>
