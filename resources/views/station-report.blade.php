<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Station Report</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo {
            width: 100px;
            height: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border: 1px solid black; /* Default border */
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
            text-align: center;
            margin-bottom: 20px;
        }

        .header-info h1 {
            margin: 0;
            font-size: 24px;
        }

        .header-info h2 {
            margin: 0;
            font-size: 18px;
        }

        .header-info h3 {
            margin: 0;
            font-size: 16px;
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
        <img src="/public/assets/logo-bmkg.png" alt="BMKG Logo" class="logo">
        <div class="header-info">
            <h1>Badan Meteorologi, Klimatologi, dan Geofisika</h1>
            <h2>Jl. Angkasa I No.2, Kemayoran, Jakarta 10720</h2>
            <h3>Email: info@bmkg.go.id | Website: www.bmkg.go.id</h3>
        </div>
    </div>

    <h2><strong>{{ $stationName }}</strong></h2>

    <h3 class="table-title">Detail Persentase Pembacaan Flagging</h3>
    <table id="flagging-table">
        <thead>
            <tr>
                <th>Kategori</th>
                <th>Tanggal (Hari/Bulan/Tahun)</th>
                <th>Presentase</th>
            </tr>
        </thead>
        <tbody>
            {{-- Valid Data --}}
            @foreach ($validData as $date => $value)
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

            {{-- Invalid Data --}}
            @foreach ($invalidData as $date => $flags)
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

            {{-- Missing Data --}}
            @foreach ($missingData as $date => $value)
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

    <div class="chart-container">
        <h3>Chart: Station Data</h3>
        <canvas id="chart"></canvas>
    </div>

    <h3 class="table-title">Detail Persentase Chart</h3>
    <table id="chart-table">
        <thead>
            <tr>
                <th>Kategori</th>
                <th>Tanggal (Hari/Bulan/Tahun)</th>
                <th>Presentase</th>
            </tr>
        </thead>
        <tbody>
            {{-- Valid Data --}}
            @foreach ($validData as $date => $value)
                <tr>
                    @if ($loop->first)
                        <td style="background-color: #006d7e; font-weight: bold;">Valid</td>
                    @else
                        <td style="background-color: #006d7e;"></td>
                    @endif
                    <td>{{ $date }}</td>
                    <td>{{ $value }}%</td>
                </tr>
            @endforeach

            {{-- Invalid Data --}}
            @foreach ($invalidData as $date => $flags)
                <tr>
                        @if ($loop->first)
                            <td style="background-color: #f7c92e; font-weight: bold;">Invalid</td>
                        @else
                            <td style="background-color: #f7c92e;"></td>
                        @endif
                    <td>{{ $date }}</td>
                    <td>{{ array_sum($flags) }}%</td>
                </tr>
            @endforeach

            {{-- Missing Data --}}
            @foreach ($missingData as $date => $value)
                <tr>
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

    <script>
        // Function to check if a table is empty and hide top/bottom borders
        function checkTableEmpty(tableId) {
            const table = document.getElementById(tableId);
            const tbody = table.querySelector('tbody');
            if (tbody.children.length === 0) {
                table.classList.add('empty-table');
            } else {
                table.classList.remove('empty-table');
            }
        }

        // Check tables on page load
        document.addEventListener('DOMContentLoaded', () => {
            checkTableEmpty('flagging-table');
            checkTableEmpty('chart-table');
        });

        // Chart initialization
        const chartData = @json($chartData);

        const ctx = document.getElementById('chart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: chartData.dates,
                datasets: [
                    {
                        label: 'Valid',
                        data: chartData.valid,
                        backgroundColor: '#006d7e'
                    },
                    {
                        label: 'Invalid',
                        data: chartData.invalid,
                        backgroundColor: '#f7c830'
                    },
                    {
                        label: 'Missing',
                        data: chartData.missing,
                        backgroundColor: '#b12629'
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        stacked: true,
                        max: 100
                    },
                    x: {
                        stacked: true
                    }
                }
            }
        });
    </script>
</body>

</html>