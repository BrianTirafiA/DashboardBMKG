<div class="min-h-full">
    @php
    $currentRoute = request()->path(); // Mendapatkan route saat ini

    $menuItems = [
        [
            'type' => 'static',
            'title' => 'Dashboard',
            'link' => '/admin/lendasset/dashboard',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" class="w-5 h-5"> <path fill-rule="evenodd" d="M2.25 2.25a.75.75 0 000 1.5H3v10.5a3 3 0 003 3h1.21l-1.172 3.513a.75.75 0 001.424.474l.329-.987h8.418l.33.987a.75.75 0 001.422-.474l-1.17-3.513H18a3 3 0 003-3V3.75h.75a.75.75 0 000-1.5H2.25zm6.04 16.5l.5-1.5h6.42l.5 1.5H8.29zm7.46-12a.75.75 0 00-1.5 0v6a.75.75 0 001.5 0v-6zm-3 2.25a.75.75 0 00-1.5 0v3.75a.75.75 0 001.5 0V9zm-3 2.25a.75.75 0 00-1.5 0v1.5a.75.75 0 001.5 0v-1.5z" clip-rule="evenodd"></path></svg>',
            'active' => $currentRoute === 'admin/lendasset/dashboard', // Menandai aktif
        ],
        [
            'type' => 'dropdown',
            'title' => 'Peminjaman',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-fill" viewBox="0 0 16 16">
                        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                        </svg>',
            'active' => false, // Kunci active untuk dropdown
            'items' => [
                ['title' => 'Pengajuan', 'link' => '/admin/lendasset/transaksi-pengajuan', 'active' => $currentRoute === 'admin/lendasset/transaksi-pengajuan'],
                ['title' => 'Peminjaman', 'link' => '/admin/lendasset/transaksi-peminjaman', 'active' => $currentRoute === 'admin/lendasset/transaksi-peminjaman'],
                ['title' => 'Pengembalian', 'link' => '/admin/lendasset/transaksi-peminjaman', 'active' => $currentRoute === 'admin/lendasset/transaksi-peminjaman'],
            ],
        ],
        [
            'type' => 'dropdown',
            'title' => 'Laporan',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-check-fill" viewBox="0 0 16 16">
                        <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1m1.354 4.354-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708.708"/>
                        </svg>',
            'active' => false, // Kunci active untuk dropdown
            'items' => [
                ['title' => 'Mingguan', 'link' => '/admin/lendasset/report-week', 'active' => $currentRoute === 'admin/lendasset/report-week'],
                ['title' => 'Bulanan', 'link' => '/admin/lendasset/report-month', 'active' => $currentRoute === 'admin/lendasset/report-month'],
                ['title' => 'Tahunan', 'link' => '/admin/lendasset/report-year', 'active' => $currentRoute === 'admin/lendasset/report-year'],
            ],
        ],
        [
            'type' => 'dropdown',
            'title' => 'Items',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-seam-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15.528 2.973a.75.75 0 0 1 .472.696v8.662a.75.75 0 0 1-.472.696l-7.25 2.9a.75.75 0 0 1-.557 0l-7.25-2.9A.75.75 0 0 1 0 12.331V3.669a.75.75 0 0 1 .471-.696L7.443.184l.01-.003.268-.108a.75.75 0 0 1 .558 0l.269.108.01.003zM10.404 2 4.25 4.461 1.846 3.5 1 3.839v.4l6.5 2.6v7.922l.5.2.5-.2V6.84l6.5-2.6v-.4l-.846-.339L8 5.961 5.596 5l6.154-2.461z"/>
                        </svg>',
            'active' => false, // Kunci active untuk dropdown
            'items' => [
                ['title' => 'Barang / Lisensi', 'link' => '/admin/lendasset/items', 'active' => $currentRoute === 'admin/lendasset/items'],
                ['title' => 'Kategori', 'link' => '/admin/lendasset/kategori', 'active' => $currentRoute === 'admin/lendasset/kategori'],
                ['title' => 'Status', 'link' => '/admin/lendasset/status', 'active' => $currentRoute === 'admin/lendasset/status'],
                ['title' => 'Brand / Merek', 'link' => '/admin/lendasset/brand', 'active' => $currentRoute === 'admin/lendasset/brand'],
                ['title' => 'Lokasi', 'link' => '/admin/lendasset/lokasi', 'active' => $currentRoute === 'admin/lendasset/lokasi'],
            ],
        ],
        [
            'type' => 'dropdown',
            'title' => 'Users',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                        <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
                        </svg>',
            'active' => false, // Kunci active untuk dropdown
            'items' => [
                ['title' => 'Pengguna', 'link' => '/admin/lendasset/users', 'active' => $currentRoute === 'admin/lendasset/users'],
                ['title' => 'Unit Kerja', 'link' => '/admin/lendasset/unitkerja', 'active' => $currentRoute === 'admin/lendasset/unitkerja'],
            ],
        ],
        [
            'type' => 'static',
            'title' => 'Edit FAQ',
            'link' => '/admin/lendasset/edit-faq',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-square-fill" viewBox="0 0 16 16">
                        <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm3.496 6.033a.237.237 0 0 1-.24-.247C5.35 4.091 6.737 3.5 8.005 3.5c1.396 0 2.672.73 2.672 2.24 0 1.08-.635 1.594-1.244 2.057-.737.559-1.01.768-1.01 1.486v.105a.25.25 0 0 1-.25.25h-.81a.25.25 0 0 1-.25-.246l-.004-.217c-.038-.927.495-1.498 1.168-1.987.59-.444.965-.736.965-1.371 0-.825-.628-1.168-1.314-1.168-.803 0-1.253.478-1.342 1.134-.018.137-.128.25-.266.25h-.825zm2.325 6.443c-.584 0-1.009-.394-1.009-.927 0-.552.425-.94 1.01-.94.609 0 1.028.388 1.028.94 0 .533-.42.927-1.029.927"/>
                        </svg>',
            'active' => $currentRoute === 'admin/lendasset/edit-faq', // Menandai aktif
        ],
    ];
    @endphp

    <x-sidebar :menuItems="$menuItems" />
</div>
