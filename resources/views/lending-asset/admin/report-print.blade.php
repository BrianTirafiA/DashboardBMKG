<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Rack Attributes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .header {
            background-color: #f0f0f0;
            padding: 20px;
            border-bottom: 2px solid #000;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
        }

        .header-table td {
            vertical-align: middle;
            padding: 10px;
        }

        .logo-container {
            width: 80px;
            text-align: center;
        }

        .logo-container img {
            width: 70px;
            height: auto;
        }

        .kop-text {
            text-align: left;
        }

        .kop-text h1 {
            margin: 0;
            font-size: 19px;
        }

        .kop-text h2 {
            margin: 5px 0;
            font-size: 12px;
        }

        .kop-text p {
            margin: 5px 0;
            font-size: 12px;
        }

        .content {
            padding: 20px;
        }

        .content table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .content th,
        .content td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        .content th {
            background-color: #f0f0f0;
            text-align: center;
        }

        @media print {
            @page {
                size: A4 landscape;
                margin: 20mm;
            }
        }
    </style>
</head>

<body>

    <div class="header">
        <table class="header-table">
            <tr>
                <td class="logo-container">
                    <img src="/public/assets/logo-bmkg.png" alt="Logo BMKG">
                </td>
                <td class="kop-text">
                    <h1>BADAN METEOROLOGI, KLIMATOLOGI, DAN GEOFISIKA</h1>
                    <h2>DEPUTI BIDANG INFRASTRUKTUR METEOROLOGI, KLIMATOLOGI, DAN GEOFISIKA</h2>
                    <h2>DIREKTORAT DATA DAN KOMPUTASI</h2>
                    <p>Jl. Angkasa I No. 2, Jakarta 10610 Telp: (021) 4246321 Fax: (021) 4246703</p>
                    <p>P.O. BOX 3540 JKT, Website: <a href="http://www.bmkg.go.id">www.bmkg.go.id</a> Email: <a
                            href="pusatdatabase@bmkg.go.id">pusatdatabase@bmkg.go.id</a></p>
                </td>
            </tr>
        </table>
    </div>

    <div class="content">
        <p style="text-align: center; margin: 2px 0; font-size: 16px;">Laporan Rack Attributes</p>

        <p style="text-align: center; font-size: 14px; text-transform: capitalize;">
            Dibuat otomatis pada {{ now()->format('d F Y') }}
        </p>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Attribute Name</th>
                    <th>Value</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rackAttributes as $attribute)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $attribute->attribute_name }}</td>
                        <td>{{ $attribute->value }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="footer">
        <p>© 2025 Badan Meteorologi, Klimatologi, dan Geofisika. All rights reserved.</p>
    </div>

    <script>
        window.print();
    </script>

</body>

</html>