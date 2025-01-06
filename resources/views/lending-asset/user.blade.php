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
    
    <header class="bg-white shadow">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">Website Peminjaman Asset - Direktorat Data dan Komputasi</h1>
        </div>
    </header>

    <x-sidebar-lending />

    <x-footer/>
</div>
</body>
</html>
