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

        .content {}

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

        .detail-table {
            width: 100%;
            border-collapse: collapse;
        }

        .detail-table td {
            border: none;
        }

        .detail-table td:first-child {
            text-align: left;
            font-weight: bold;
            width: 40%;
        }

        .content ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .content li {
            margin-bottom: 5px;
        }

        .footer {
            margin-top: 20px;
            text-align: left;
            font-size: 12px;
            border-top: 1px solid #000;
            padding-top: 10px;
        }
    </style>
</head>

<body>

    <div class="content">
        <p style="text-align: left; margin: 0; font-size: 16px;"> Dear, {{ $details['fullname'] }} </p>
        <p style="text-align: left; margin: 0; font-size: 16px;"> Peminjaman barang/lisensi/layanan anda, sudah diterima dengan keterangan:</p>
        <p style="text-align: left; margin: 0; font-size: 16px;"> No. Tiket:  {{ $details['tiket'] }} </p>
        <p 
    style="text-align: left; margin: 0; font-size: 16px;" 
    class="
        {{
            ($details['approval_status'] === 'rejected') ? 'bg-red-500 rounded-full' :
            (($details['approval_status'] === 'approved' || $details['approval_status'] === 'onprocess') ? 'bg-green-500' : 
            ($details['approval_status'] === 'returned' ? 'bg-yellow-500' : ''))
        }}
        px-4 py-2 text-white
    "
>
    Status: {{ $details['approval_status'] }}
</p>

        <p style="text-align: left; margin: 0; font-size: 16px;"> Pesan Admin: {!! nl2br(e($details['note'] ?? 'Perbaruan lebih lanjut dapat dilihat melalui website Asset Management System - Direktorat Data dan Komputasi')) !!}</p>


        <p style="text-align: left; margin: 0; margin-top: 10px; font-size: 16px;"> Anda tidak perlu membalas surel ini. Surel ini dikirim secara otomastis pada {{ now()->format('d F Y') }} </p>
        <p style="text-align: left; margin: 0; font-size: 16px;"> oleh Layanan Website Manajemen Asset - Direktorat Data dan Komputasi BMKG Pusat</a> </p>
        <p style="text-align: left; margin: 0; font-size: 16px;"> Terima Kasih telah menggunakan layanan kami </p>

        <p style="text-align: left; margin: 0; margin-top: 10px; font-size: 16px;"> Regards,</p>
        <p style="text-align: left; margin: 0; font-size: 16px;"> {{ $details['fullname_admin'] }}</p>
        <p style="text-align: left; margin: 0; font-size: 16px;"> NIP: {{ $details['nip_admin'] }}</p>
        <p style="text-align: left; margin: 0; font-size: 16px;"> Email: {{ $details['email_admin'] }}</p>
    </div>

    <div class="footer">
        <p>© 2025 Direktorat Data dan Komputasi - Deputi Bidang Infrastruktur Meteorologi Klimatologi dan Geofisika -
            Badan Meteorologi, Klimatologi, dan Geofisika. All rights reserved.</p>
    </div>

    <div class="header">
        <table class="header-table">
            <tr>
                <td class="logo-container">
                    <img src="https://ekarahmadi.github.io/supersonikChant/logo-bmkg.png" alt="Logo BMKG">
                </td>
                <td class="kop-text">
                    <h1>BADAN METEOROLOGI, KLIMATOLOGI, DAN GEOFISIKA</h1>
                    <h2>DEPUTI BIDANG INFRASTRUKTUR METEOROLOGI, KLIMATOLOGI, DAN GEOFISIKA</h2>
                    <h2>DIREKTORAT DATA DAN KOMPUTASI</h2>
                    <p>Jl. Angkasa I No. 2, Jakarta 10610 Telp: (021) 4246321 Fax: (021) 4246703</p>
                    <p>P.O. BOX 3540 JKT, Website: <a href="http://www.bmkg.go.id">www.bmkg.go.id</a> Email:
                        <a href="pusatdatabase@bmkg.go.id">pusatdatabase@bmkg.go.id</a>
                    </p>
                </td>
            </tr>
        </table>
    </div>



</body>

</html>