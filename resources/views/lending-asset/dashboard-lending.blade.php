<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="h-full">
<div class="min-h-full">
    <x-navbar :menu-items="[
        ['label' => 'QC Dashboard', 'link' => '/qcdashboard', 'active' => false],
        ['label' => 'It Asset', 'link' => '/itasset', 'active' => false],
        ['label' => 'Lending Items', 'link' => '/lendingitems', 'active' => true],
        ['label' => 'Calendar', 'link' => '#', 'active' => false],
        ['label' => 'Reports', 'link' => '#', 'active' => false],
    ]" />
    
    <div class="flex">
        <!-- Sidebar -->
        <div class="w-1/4 p-4">
            <x-sidebar-lending />
        </div>

        <!-- Main Content -->
        <div class="w-3/4 p-4">
            <h2 class="text-2xl font-semibold">Konten Utama</h2>
            <p>Ini adalah konten utama halaman. Anda dapat menambahkan lebih banyak informasi di sini.</p>
            <!-- Tambahkan konten lainnya di sini -->
        </div>
    </div>

    <x-footer/>
</div>
</body>
</html>
