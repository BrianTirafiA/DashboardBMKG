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
    @php
    $menuItems = [
    [
        'type' => 'static',
        'title' => 'Dashboard',
        'link' => '/Dashboard',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"class="w-5 h-5"> <path fill-rule="evenodd" d="M2.25 2.25a.75.75 0 000 1.5H3v10.5a3 3 0 003 3h1.21l-1.172 3.513a.75.75 0 001.424.474l.329-.987h8.418l.33.987a.75.75 0 001.422-.474l-1.17-3.513H18a3 3 0 003-3V3.75h.75a.75.75 0 000-1.5H2.25zm6.04 16.5l.5-1.5h6.42l.5 1.5H8.29zm7.46-12a.75.75 0 00-1.5 0v6a.75.75 0 001.5 0v-6zm-3 2.25a.75.75 0 00-1.5 0v3.75a.75.75 0 001.5 0V9zm-3 2.25a.75.75 0 00-1.5 0v1.5a.75.75 0 001.5 0v-1.5z" clip-rule="evenodd"></path></svg>',
    ],
    [
        'type' => 'dropdown',
        'title' => 'Transaksi',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"class="w-5 h-5"> <path fill-rule="evenodd" d="M2.25 2.25a.75.75 0 000 1.5H3v10.5a3 3 0 003 3h1.21l-1.172 3.513a.75.75 0 001.424.474l.329-.987h8.418l.33.987a.75.75 0 001.422-.474l-1.17-3.513H18a3 3 0 003-3V3.75h.75a.75.75 0 000-1.5H2.25zm6.04 16.5l.5-1.5h6.42l.5 1.5H8.29zm7.46-12a.75.75 0 00-1.5 0v6a.75.75 0 001.5 0v-6zm-3 2.25a.75.75 0 00-1.5 0v3.75a.75.75 0 001.5 0V9zm-3 2.25a.75.75 0 00-1.5 0v1.5a.75.75 0 001.5 0v-1.5z" clip-rule="evenodd"></path></svg>',
        'items' => [
            ['title' => 'Pengajuan', 'link' => '/transaksi-pengajuan', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M3 3h18v18H3V3z" /></svg>'],
            ['title' => 'Peminjaman', 'link' => '/transaksi-peminjaman', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M3 3h18v18H3V3z" /></svg>'],
            ['title' => 'Pengembalian', 'link' => '/transaksi-pengembalian', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M3 3h18v18H3V3z" /></svg>'],
        ],
    ],
    [
        'type' => 'dropdown',
        'title' => 'Laporan',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M3 3h18v18H3V3z" /></svg>',
        'items' => [
            ['title' => 'Mingguan', 'link' => '/report-week', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M3 3h18v18H3V3z" /></svg>'],
            ['title' => 'Bulanan', 'link' => '/report-month', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M3 3h18v18H3V3z" /></svg>'],
            ['title' => 'Tahunan', 'link' => '/report-year', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M3 3h18v18H3V3z" /></svg>']
        ],
    ],
    [
        'type' => 'static',
        'title' => 'Items',
        'link' => '/items',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M3 3h18v18H3V3z" /></svg>',
    ],
    [
        'type' => 'static',
        'title' => 'User',
        'link' => '/user',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M3 3h18v18H3V3z" /></svg>',
    ],
    [
        'type' => 'static',
        'title' => 'Settings',
        'link' => '/settings',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M3 3h18v18H3V3z" /></svg>',
    ],
    [
        'type' => 'static',
        'title' => 'FAQ',
        'link' => '/lending-faq',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M3 3h18v18H3V3z" /></svg>',
    ],
    ];
    @endphp

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

    <x-sidebar :menuItems="$menuItems" />

    <x-footer/>
</div>
</body>
</html>
