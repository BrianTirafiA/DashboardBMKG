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

        table th,
        table td {
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

        .header-info h2 {
            margin: 5px 0;
            font-size: 12px;
        }

        .header-info h3 {
            margin: 5px 0;
            font-size: 12px;
        }

        /* Hide top and bottom borders if the table is empty */
        table.empty-table {
            border-top: none;
            border-bottom: none;
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
                    <h3>Jl. Angkasa I No. 2, Jakarta 10610 Telp: (021) 4246321 Fax: (021) 4246703</h3>
                    <h3>P.O. BOX 3540 JKT, Website: <a href="http://www.bmkg.go.id">www.bmkg.go.id</a> Email: <a
                            href="pusatdatabase@bmkg.go.id">pusatdatabase@bmkg.go.id</a></h3>
                </td>
            </tr>
        </table>
    </div>

    @foreach ($reportData as $data)
        <h2><strong>{{ $data['stationName'] }}</strong></h2>

        <h3>Detail Persentase Pembacaan Flagging</h3>
        <table>
            <thead>
                <tr>
                    <th style="background-color: #f0f0f0; font-weight: bold;">Kategori</th>
                    <th style="background-color: #f0f0f0; font-weight: bold;">Tanggal (Hari/Bulan/Tahun)</th>
                    <th style="background-color: #f0f0f0; font-weight: bold;">Presentase</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data['validData'] as $date => $value)
                    <tr>
                        {{-- Show "Valid" only for the first row in the group --}}
                        @if ($loop->first)
                            <td style="background-color: #006d7e; font-weight: bold;">Valid</td>
                        @else
                            <td style="background-color: #006d7e;"></td>
                        @endif
                        <td>{{ $date }}</td>
                        <td>{{ $value }}%</td>
                    </tr>
                @endforeach
                @foreach ($data['invalidData'] as $date => $flags)
                    @foreach ($flags as $flagNumber => $flagValue)
                        <tr>
                            {{-- Show "Invalid" only for the first row in the group --}}
                            @if ($loop->parent->first && $loop->first)
                                <td style="background-color: #f7c92e; font-weight: bold;">Invalid</td>
                            @else
                                <td style="background-color: #f7c92e;"></td>
                            @endif
                            @if ($loop->first)
                                <td>{{ $date }}</td>
                            @else
                                <td></td>
                            @endif
                            <td>Flag {{ $flagNumber }}: {{ $flagValue }}%</td>
                        </tr>
                    @endforeach
                @endforeach
                @foreach ($data['missingData'] as $date => $value)
                    <tr>
                        {{-- Show "Missing" only for the first row in the group --}}
                        @if ($loop->first)
                            <td style="background-color: #b12629; font-weight: bold;">Missing</td>
                        @else
                            <td style="background-color: #b12629;"></td>
                        @endif
                        <td>{{ $date }}</td>
                        <td>{{ $value }}%</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- <div class="chart-container">
            <h3>Chart: {{ $data['stationName'] }}</h3>
            <canvas id="chart-{{ $loop->index }}"></canvas>
            <script>
                var ctx = document.getElementById("chart-{{ $loop->index }}").getContext('2d');
                var chartData = {!! $data['chartData'] !!};

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: chartData.dates,
                        datasets: [
                            { label: 'Valid', data: chartData.valid, backgroundColor: '#006d7e' },
                            { label: 'Invalid', data: chartData.invalid, backgroundColor: '#f7c92e' },
                            { label: 'Missing', data: chartData.missing, backgroundColor: '#b12629' }
                        ]
                    },
                    options: { responsive: true }
                });
            </script>
        </div> -->

        <hr>
    @endforeach
</body>

</html>