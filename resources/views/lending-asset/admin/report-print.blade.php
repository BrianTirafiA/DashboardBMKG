<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Peminjaman</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        /* === Header Section === */
        .header {
            background-color: #f0f0f0;
            padding: 20px;
            border-bottom: 2px solid #000;
        }

        /* Tabel dalam header */
        .header-table {
            width: 100%;
            border-collapse: collapse;
        }

        .header-table td {
            vertical-align: middle;
            padding: 10px;
        }

        /* === Logo Styling === */
        .logo-container {
            width: 80px;
            text-align: center;
        }

        .logo-container img {
            width: 70px;
            height: auto;
        }

        /* === Teks Kop Surat === */
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

        /* === Konten Laporan === */
        .content {
            padding: 20px;
        }

        .content table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .content th,
        .content td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        .content th {
            background-color: #f0f0f0;
        }
    </style>
</head>

<body>

    <div class="header">
        <table class="header-table">
            <tr>
                <!-- Kolom Logo -->
                <td class="logo-container">
                    <img src="/public/assets/logo-bmkg.png" alt="Logo BMKG">
                </td>
                <!-- Kolom Teks Kop Surat -->
                <td class="kop-text">
                    <h1>BADAN METEOROLOGI, KLIMATOLOGI, DAN GEOFISIKA</h1>
                    <h2>DEPUTI BIDANG INFRASTRUKTUR METEOROLOGI, KLIMATOLOGI, DAN GEOFISIKA</h2>
                    <h2>DIREKTORAT DATA DAN KOMPUTASI</h2>
                    <p>Jl. Angkasa I No. 2, Jakarta 10610 Telp: (021) 4246321 Fax: (021) 4246703</p>
                    <p>P.O. BOX 3540 JKT, Website: <a href="http://www.bmkg.go.id">www.bmkg.go.id</a></p>
                </td>
            </tr>
        </table>
    </div>

    <div class="content">
        <p style="text-align: center; margin: 2px 0; font-size: 16px;">Laporan Transaksi Peminjaman</p>
        <p style="text-align: center; margin: 2px 0; font-size: 16px;">Pada Layanan Website Manajemen Asset Direktorat Data dan Komputasi</p>
        <p style="text-align: center; margin: 2px 0; font-size: 16px;">Dikutip dan dibuat otomatis pada {{ now()->format('d F Y') }}</p>


        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Pemohon</th>
                    <th>Durasi (Hari)</th>
                    <th>Status</th>
                    <th>Tanggal Pengajuan</th>
                    <th>Tanggal Diterima</th>
                    <th>Tanggal Pengembalian</th>
                    <th>Admin Penerima</th>
                    <th>Item (Jumlah)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($loan_requests as $request)
                    <tr>
                        <td>{{ $request->id }}</td>
                        <td>{{ $request->user->fullname }}</td>
                        <td>{{ $request->durasi_peminjaman }}</td>
                        <td>{{ $request->approval_status }}</td>
                        <td>{{ $request->tanggal_pengajuan }}</td>
                        <td>{{ $request->approval_date }}</td>
                        <td>{{ $request->returned_date }}</td>
                        <td>{{ $request->admin->fullname }}</td>
                        <td>
                            <ul>
                                @foreach ($request->items as $item)
                                    <li>{{ $item->itemDetail->nama_item }} ({{ $item->quantity }})</li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>

</html>