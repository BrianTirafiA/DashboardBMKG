<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Barang/Lisensi Peminjaman - Admin</title>
</head>

<x-user-layout-template>
    <div class="mt-1 flex flex-wrap gap-4">
        <div class="flex-row">
            <div class="flex justify-between">
                <div class="mb-3">
                    <h5 class="block font-sans text-xl font-semibold leading-snug tracking-normal text-blue-gray-900">
                        Daftar Barang / Lisensi yang dapat diajukan peminjaman
                    </h5>
                    <p class="block  font-sans text-base font-normal leading-relaxed text-gray-700">
                        Masukkan keranjang untuk pengajuan beberapa item sekaligus (Keranjang hanya bersifat sementara)
                    </p>
                </div>

                <div class="me-1">
                    <button id="LihatCart" onclick="openCartModal()"
                        class="block bg-[#F1F5F9] w-full flex gap-2 select-none rounded-lg bg-blue-gray-900/10 p-3 text-center align-middle font-sans text-xs font-bold uppercase text-blue-gray-900 transition-all border border-gray-300 hover:scale-105 focus:scale-105 focus:opacity-[0.85] active:scale-100 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-bag-heart-fill" viewBox="0 0 16 16">
                            <path
                                d="M11.5 4v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m0 6.993c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132" />
                        </svg>
                        Lihat Keranjang
                    </button>
                </div>
            </div>

            <div class="flex gap-5">
                <!-- Search Form -->
                <div class="w-[39rem]">
                    <form action="{{ route('item.index') }}" method="GET"
                        class="relative h-10 w-full min-w-[250px] bg-white">
                        <input id="searchInput" name="search"
                            class="peer h-full w-full rounded-[7px] border border-blue-gray-200 bg-transparent px-3 py-2.5 text-sm text-blue-gray-700 outline-none transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 focus:border-2 focus:border-gray-900"
                            placeholder="Temukan Barang/Lisensi yang hendak dipinjam" value="{{ request('search') }}" />
                        <button type="submit" class="absolute right-3 top-2.5 text-blue-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z">
                                </path>
                            </svg>
                        </button>
                    </form>
                </div>

                <!-- Filter by Kategori -->
                <div class="relative flex items-center">
                    <div class="absolute left-3 top-1/2 transform -translate-y-1/2 pointer-events-none -mt-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-bookmarks-fill" viewBox="0 0 16 16">
                            <path
                                d="M2 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v11.5a.5.5 0 0 1-.777.416L7 13.101l-4.223 2.815A.5.5 0 0 1 2 15.5z" />
                            <path
                                d="M4.268 1A2 2 0 0 1 6 0h6a2 2 0 0 1 2 2v11.5a.5.5 0 0 1-.777.416L13 13.768V2a1 1 0 0 0-1-1z" />
                        </svg>
                    </div>
                    <form action="{{ route('item.index') }}" method="GET" class="flex items-center mb-4">
                        <select name="category" onchange="this.form.submit()"
                            class="w-72 text-sm text-gray-800 border border-gray-300 px-10 py-2 rounded-md outline-blue-600 appearance-none">
                            <option value="">Filter Berdasarkan Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name_category }}
                                </option>
                            @endforeach
                        </select>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-caret-down -ms-7 mt-1" viewBox="0 0 16 16">
                                <path
                                    d="M3.204 5h9.592L8 10.481zm-.753.659 4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659">
                                </path>
                            </svg>
                        </div>
                    </form>
                </div>

                <!-- Filter by Merek -->
                <div class="relative flex items-center">
                    <div class="absolute left-3 top-1/2 transform -translate-y-1/2 pointer-events-none -mt-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-apple" viewBox="0 0 16 16">
                            <path
                                d="M11.182.008C11.148-.03 9.923.023 8.857 1.18c-1.066 1.156-.902 2.482-.878 2.516s1.52.087 2.475-1.258.762-2.391.728-2.43m3.314 11.733c-.048-.096-2.325-1.234-2.113-3.422s1.675-2.789 1.698-2.854-.597-.79-1.254-1.157a3.7 3.7 0 0 0-1.563-.434c-.108-.003-.483-.095-1.254.116-.508.139-1.653.589-1.968.607-.316.018-1.256-.522-2.267-.665-.647-.125-1.333.131-1.824.328-.49.196-1.422.754-2.074 2.237-.652 1.482-.311 3.83-.067 4.56s.625 1.924 1.273 2.796c.576.984 1.34 1.667 1.659 1.899s1.219.386 1.843.067c.502-.308 1.408-.485 1.766-.472.357.013 1.061.154 1.782.539.571.197 1.111.115 1.652-.105.541-.221 1.324-1.059 2.238-2.758q.52-1.185.473-1.282" />
                            <path
                                d="M11.182.008C11.148-.03 9.923.023 8.857 1.18c-1.066 1.156-.902 2.482-.878 2.516s1.52.087 2.475-1.258.762-2.391.728-2.43m3.314 11.733c-.048-.096-2.325-1.234-2.113-3.422s1.675-2.789 1.698-2.854-.597-.79-1.254-1.157a3.7 3.7 0 0 0-1.563-.434c-.108-.003-.483-.095-1.254.116-.508.139-1.653.589-1.968.607-.316.018-1.256-.522-2.267-.665-.647-.125-1.333.131-1.824.328-.49.196-1.422.754-2.074 2.237-.652 1.482-.311 3.83-.067 4.56s.625 1.924 1.273 2.796c.576.984 1.34 1.667 1.659 1.899s1.219.386 1.843.067c.502-.308 1.408-.485 1.766-.472.357.013 1.061.154 1.782.539.571.197 1.111.115 1.652-.105.541-.221 1.324-1.059 2.238-2.758q.52-1.185.473-1.282" />
                        </svg>
                    </div>
                    <form action="{{ route('item.index') }}" method="GET" class="flex items-center mb-4">
                        <select name="brand" onchange="this.form.submit()"
                            class="w-72 text-sm text-gray-800 border border-gray-300 px-10 py-2 rounded-md outline-blue-600 appearance-none">
                            <option value="">Filter Berdasarkan Merek</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}" {{ request('brand') == $brand->id ? 'selected' : '' }}>
                                    {{ $brand->name_brand }}
                                </option>
                            @endforeach
                        </select>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-caret-down -ms-7 mt-1" viewBox="0 0 16 16">
                                <path
                                    d="M3.204 5h9.592L8 10.481zm-.753.659 4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659">
                                </path>
                            </svg>
                        </div>
                    </form>
                </div>

                <!-- Filter by Lokasi -->
                <div class="relative flex items-center">
                    <div class="absolute left-3 top-1/2 transform -translate-y-1/2 pointer-events-none -mt-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-geo-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999zm2.493 8.574a.5.5 0 0 1-.411.575c-.712.118-1.28.295-1.655.493a1.3 1.3 0 0 0-.37.265.3.3 0 0 0-.057.09V14l.002.008.016.033a.6.6 0 0 0 .145.15c.165.13.435.27.813.395.751.25 1.82.414 3.024.414s2.273-.163 3.024-.414c.378-.126.648-.265.813-.395a.6.6 0 0 0 .146-.15l.015-.033L12 14v-.004a.3.3 0 0 0-.057-.09 1.3 1.3 0 0 0-.37-.264c-.376-.198-.943-.375-1.655-.493a.5.5 0 1 1 .164-.986c.77.127 1.452.328 1.957.594C12.5 13 13 13.4 13 14c0 .426-.26.752-.544.977-.29.228-.68.413-1.116.558-.878.293-2.059.465-3.34.465s-2.462-.172-3.34-.465c-.436-.145-.826-.33-1.116-.558C3.26 14.752 3 14.426 3 14c0-.599.5-1 .961-1.243.505-.266 1.187-.467 1.957-.594a.5.5 0 0 1 .575.411" />
                        </svg>
                    </div>
                    <form action="{{ route('item.index') }}" method="GET" class="flex items-center mb-4">
                        <select name="location" onchange="this.form.submit()"
                            class="w-80 text-sm text-gray-800 border border-gray-300 px-10 py-2 rounded-md outline-blue-600 appearance-none">
                            <option value="">Filter Berdasarkan Lokasi</option>
                            @foreach ($locations as $location)
                                <option value="{{ $location->id }}" {{ request('location') == $location->id ? 'selected' : '' }}> {{ $location->nama_lokasi }}</option>
                            @endforeach
                        </select>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-caret-down -ms-7 mt-1" viewBox="0 0 16 16">
                                <path
                                    d="M3.204 5h9.592L8 10.481zm-.753.659 4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659">
                                </path>
                            </svg>
                        </div>
                    </form>
                </div>

            </div>


            <div id="pilihanitem"
                class="flex min-h-[46rem] w-[99rem] p-7 mt-2 gap-5 border border-blue-gray-100 rounded-xl overflow-x-scroll scrollbar-thumb-rounded-full scrollbar-track-rounded-full scrollbar scrollbar-thumb-slate-700 scrollbar-track-slate-300">
                @php
                    // Pisahkan item menjadi dua array
                    $activeItems = [];
                    $inactiveItems = [];

                    foreach ($item_details as $item) {
                        if ($item->jumlah_item - $item->borrowed_quantity > 0 && $item->status->name_status === 'Available') {
                            $activeItems[] = $item; // Item aktif
                        } else {
                            $inactiveItems[] = $item; // Item tidak aktif
                        }
                    }

                    // Gabungkan kembali item aktif dan tidak aktif
                    $sortedItems = array_merge($activeItems, $inactiveItems);
                @endphp
                @foreach ($sortedItems as $item)
                                @php
                                    // Cek apakah item tidak tersedia
                                    $isInactive = ($item->jumlah_item - $item->borrowed_quantity <= 0 || $item->status->name_status !== 'Available');
                                @endphp
                                <div id="carditem"
                                    class="flex-shrink-0 w-[18rem] min-w-[18rem] flex flex-col rounded-xl shadow-md shadow-blue-gray-900 border border-blue-gray-100 border-collapse bg-clip-border {{ $isInactive ? 'opacity-50 bg-gray-300 border-gray-500 pointer-events-none' : '' }}">
                                    <div
                                        class="relative mx-4 mt-4 h-64 overflow-hidden rounded-xl bg-white bg-clip-border border border-gray-300 text-gray-700 {{ $isInactive ? 'border-gray-500' : '' }}">
                                        <!-- Image Display -->
                                        <img id="image-{{ $item->id }}"
                                            src="{{ $item->image1_url ?? asset('assets/default-profile.png') }}"
                                            class="h-full w-full object-cover" alt="Image Not Found">

                            
                                    </div>

                                    <div class="p-5">
                                        <div class="p-2 -mt-4 flex items-center justify-between gap-2 rounded-xl">
                                            <p
                                                class="block font-sans text-base font-medium text-center leading-relaxed text-blue-gray-900 mb-2 antialiased">
                                                {{ $item->nama_item ?? "-"}}
                                            </p>
                                            <p
                                                class="block font-sans text-base font-medium text-center leading-relaxed text-blue-gray-900 mb-2 antialiased">
                                                {{ $item->type_item }}
                                            </p>
                                        </div>

                                        <p
                                            class="block p-2 -mt-6 font-sans text-sm font-normal leading-normal text-gray-700 antialiased opacity-75">
                                            {{ $item->description ?? "-"}}
                                        </p>

                                        <div
                                            class="flex-row border border-gray-30 w-full p-3 rounded-xl mb-3 {{ $isInactive ? 'border-gray-500' : '' }}">
                                            <div class="flex justify-between">
                                                <p class="block font-sans text-sm leading-relaxed b text-blue-gray-900 antialiased">
                                                    Brand
                                                </p>
                                                <p class="block font-sans text-sm leading-relaxed b text-blue-gray-900 antialiased">
                                                    Kategori
                                                </p>
                                            </div>

                                            <div class="flex justify-between">
                                                <p
                                                    class="block font-sans text-sm font-medium leading-relaxed b text-blue-gray-900 antialiased">
                                                    {{ $item->brand->name_brand ?? "-" }}
                                                </p>
                                                <p
                                                    class="block font-sans text-sm font-medium leading-relaxed b text-blue-gray-900 antialiased">
                                                    {{ $item->category->name_category ?? "-"}}
                                                </p>
                                            </div>
                                        </div>

                                        <div
                                            class="flex-row border border-gray-30 w-full p-3 rounded-xl mb-3 {{ $isInactive ? 'border-gray-500' : '' }}">
                                            <div class="flex justify-between">
                                                <p class="block font-sans text-sm leading-relaxed b text-blue-gray-900 antialiased">
                                                    Status
                                                </p>
                                                <p class="block font-sans text-sm leading-relaxed b text-blue-gray-900 antialiased">
                                                    Jumlah
                                                </p>
                                            </div>

                                            <div class="flex justify-between">
                                                <p
                                                    class="block font-sans text-sm font-medium leading-relaxed b text-blue-gray-900 antialiased">
                                                    {{ $item->status->name_status ?? "-" }}
                                                </p>
                                                <p id="available_quantity"
                                                    class="block font-sans text-sm font-medium leading-relaxed b text-blue-gray-900 antialiased">
                                                    {{ $item->jumlah_item - $item->borrowed_quantity ?? "-"}} pcs
                                                </p>
                                            </div>
                                        </div>

                                        <div
                                            class="flex-row border border-gray-30 w-full p-3 rounded-xl justify-between mb-3 {{ $isInactive ? 'border-gray-500' : '' }} ">


                                            <div class="mb-2 flex items-center gap-5">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                                    class="bi bi-geo-fill" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd"
                                                        d="M4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999zm2.493 8.574a.5.5 0 0 1-.411.575c-.712.118-1.28.295-1.655.493a1.3 1.3 0 0 0-.37.265.3.3 0 0 0-.057.09V14l.002.008.016.033a.6.6 0 0 0 .145.15c.165.13.435.27.813.395.751.25 1.82.414 3.024.414s2.273-.163 3.024-.414c.378-.126.648-.265.813-.395a.6.6 0 0 0 .146-.15l.015-.033L12 14v-.004a.3.3 0 0 0-.057-.09 1.3 1.3 0 0 0-.37-.264c-.376-.198-.943-.375-1.655-.493a.5.5 0 1 1 .164-.986c.77.127 1.452.328 1.957.594C12.5 13 13 13.4 13 14c0 .426-.26.752-.544.977-.29.228-.68.413-1.116.558-.878.293-2.059.465-3.34.465s-2.462-.172-3.34-.465c-.436-.145-.826-.33-1.116-.558C3.26 14.752 3 14.426 3 14c0-.599.5-1 .961-1.243.505-.266 1.187-.467 1.957-.594a.5.5 0 0 1 .575.411" />
                                                </svg>
                                                <p
                                                    class="block font-sans text-sm font-normal leading-normal text-gray-700 antialiased opacity-75">
                                                    {{ $item->location->nama_lokasi ?? 'N/A' }}
                                                </p>
                                            </div>
                                            <div class=" flex items-center gap-5">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                                    class="bi bi-house-add-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 1 1-1 0v-1h-1a.5.5 0 1 1 0-1h1v-1a.5.5 0 0 1 1 0" />
                                                    <path
                                                        d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z" />
                                                    <path
                                                        d="m8 3.293 4.712 4.712A4.5 4.5 0 0 0 8.758 15H3.5A1.5 1.5 0 0 1 2 13.5V9.293z" />
                                                </svg>
                                                <p
                                                    class="block font-sans text-sm font-normal leading-normal text-gray-700 antialiased opacity-75">
                                                    {{ $item->nama_vendor ?? 'N/A' }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-5 -mt-10 flex gap-3">
                                        <button id="Ajukan"
                                            class="block w-full select-none rounded-lg bg-blue-gray-900/10 py-3 px-3 text-center align-middle font-sans text-xs font-bold uppercase text-blue-gray-900 transition-all border border-gray-300 hover:scale-105 focus:scale-105 focus:opacity-[0.85] active:scale-100 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none {{ $isInactive ? 'border-gray-500' : '' }}"
                                            type="button" data-item-id="{{ $item->id }}" data-item-name="{{ $item->nama_item }}"
                                            data-item-type="{{ $item->type_item ?? "N/A"}}" data-item-image="{{$item->image1_url}}"
                                            data-item-status="{{ $item->status->name_status ?? "N/A"}}"
                                            data-item-brand="{{ $item->brand->name_brand ?? "N/A" }}"
                                            data-item-category="{{ $item->category->name_category ?? "N/A" }}"
                                            data-item-location="{{ $item->location->nama_lokasi ?? 'N/A' }}"
                                            data-item-vendor="{{ $item->nama_vendor ?? 'N/A' }}"
                                            data-available-quantity="{{ $item->jumlah_item - $item->borrowed_quantity }}"
                                            onclick="openModal(this)">
                                            Ajukan Peminjaman
                                        </button>
                                        <form action="{{ route('cart.add') }}" method="POST"
                                            class="py-3 border border-gray-300 rounded-lg bg-blue-gray-900/10 transition-all hover:scale-105 focus:scale-105 focus:opacity-[0.85] active:scale-100 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none {{ $isInactive ? 'border-gray-500' : '' }}">
                                            @csrf
                                            <input type="hidden" name="item_id" value="{{ $item->id }}">
                                            <input type="hidden" name="item_name" value="{{ $item->nama_item }}">
                                            <!-- Input tersembunyi untuk item_name -->
                                            <button type="submit" class="block w-1/5 select-none ">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                                    class="bi bi-bag-heart-fill ms-3 me-3" viewBox="0 0 16 16">
                                                    <path
                                                        d="M11.5 4v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m0 6.993c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132" />
                                                </svg>
                                            </button>
                                        </form>


                                    </div>
                                </div>
                @endforeach
            </div>

        </div>
    </div>

    <script>
        const currentIndex = {};

        function changeImage(itemId, direction) {
            if (!currentIndex[itemId]) {
                currentIndex[itemId] = 0; // Initialize index if not set
            }

            const images = itemImages[itemId];
            if (images.length === 0) return; // No images to display

            // Update index based on direction
            currentIndex[itemId] = (currentIndex[itemId] + direction + images.length) % images.length;

            // Update the image source
            document.getElementById(`image-${itemId}`).src = images[currentIndex[itemId]] || '{{ asset('assets/default-profile.png') }}';
        }
    </script>

    <!-- Modal for Loan Request -->
    <div id="loanRequestModal"
        class="fixed inset-0 z-50 hidden bg-gray-800 bg-opacity-50 flex items-center justify-center">
        <div class="bg-transparant flex gap-10 p-6 w-140">

            <!-- Keterangan Barang -->
            <div id="itemDetails" class=" w-full min-h-[40rem] h-full bg-white rounded-xl p-5">

                <div class="relative mt-2 h-64 overflow-hidden rounded-xl bg-white bg-clip-border border border-gray-300 text-gray-700 ">
                    <!-- Image Display -->
                    <img id="itemImage" 
                        class="h-full w-full object-cover" alt="Image Not Found">
                </div>
                <div class="">
                    <div class="p-2 mt-4 flex items-center justify-between gap-2 rounded-xl">
                        <span id="itemName"
                            class="block font-sans text-base font-medium text-center leading-relaxed text-blue-gray-900 mb-2 antialiased">

                        </span>
                        <span id="itemType"
                            class="block font-sans text-base font-medium text-center leading-relaxed text-blue-gray-900 mb-2 antialiased">

                        </span>
                    </div>

                    <p
                        class="block p-2 -mt-6 font-sans text-sm font-normal leading-normal text-gray-700 antialiased opacity-75">

                    </p>

                    <div
                        class="flex-row border border-gray-30 w-full p-3 rounded-xl mb-3 ">
                        <div class="flex justify-between">
                            <p class="block font-sans text-sm leading-relaxed b text-blue-gray-900 antialiased">
                                Brand
                            </p>
                            <p class="block font-sans text-sm leading-relaxed b text-blue-gray-900 antialiased">
                                Kategori
                            </p>
                        </div>

                        <div class="flex justify-between">
                            <span id="itemBrand"
                                class="block font-sans text-sm font-medium leading-relaxed b text-blue-gray-900 antialiased">

                            </span>
                            <span id="itemCategory"
                                class="block font-sans text-sm font-medium leading-relaxed b text-blue-gray-900 antialiased">

                            </span>
                        </div>
                    </div>

                    <div
                        class="flex-row border border-gray-30 w-full p-3 rounded-xl mb-3 ">
                        <div class="flex justify-between">
                            <p class="block font-sans text-sm leading-relaxed b text-blue-gray-900 antialiased">
                                Status
                            </p>
                            <p class="block font-sans text-sm leading-relaxed b text-blue-gray-900 antialiased">
                                Jumlah Tersedia
                            </p>
                        </div>

                        <div class="flex justify-between">
                            <span id="itemStatus"
                                class="block font-sans text-sm font-medium leading-relaxed b text-blue-gray-900 antialiased">

                            </span>
                            <span id="itemAvailableQuantity"
                                class="block font-sans text-sm font-medium leading-relaxed b text-blue-gray-900 antialiased">

                            </span>
                        </div>
                    </div>

                    <div
                        class="flex-row border border-gray-300 w-full p-3 rounded-xl justify-between mb-3 ">
                        <div class="mb-2 flex items-center gap-5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-geo-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999zm2.493 8.574a.5.5 0 0 1-.411.575c-.712.118-1.28.295-1.655.493a1.3 1.3 0 0 0-.37.265.3.3 0 0 0-.057.09V14l.002.008.016.033a.6.6 0 0 0 .145.15c.165.13.435.27.813.395.751.25 1.82.414 3.024.414s2.273-.163 3.024-.414c.378-.126.648-.265.813-.395a.6.6 0 0 0 .146-.15l.015-.033L12 14v-.004a.3.3 0 0 0-.057-.09 1.3 1.3 0 0 0-.37-.264c-.376-.198-.943-.375-1.655-.493a.5.5 0 1 1 .164-.986c.77.127 1.452.328 1.957.594C12.5 13 13 13.4 13 14c0 .426-.26.752-.544.977-.29.228-.68.413-1.116.558-.878.293-2.059.465-3.34.465s-2.462-.172-3.34-.465c-.436-.145-.826-.33-1.116-.558C3.26 14.752 3 14.426 3 14c0-.599.5-1 .961-1.243.505-.266 1.187-.467 1.957-.594a.5.5 0 0 1 .575.411" />
                            </svg>
                            <span id="itemLocation"
                                class="block font-sans text-sm font-normal leading-normal text-gray-700 antialiased opacity-75">
                            </span>
                        </div>
                        <div class=" flex items-center gap-5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-house-add-fill" viewBox="0 0 16 16">
                                <path
                                    d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 1 1-1 0v-1h-1a.5.5 0 1 1 0-1h1v-1a.5.5 0 0 1 1 0" />
                                <path
                                    d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z" />
                                <path d="m8 3.293 4.712 4.712A4.5 4.5 0 0 0 8.758 15H3.5A1.5 1.5 0 0 1 2 13.5V9.293z" />
                            </svg>
                            <span id="itemVendor"
                                class="block font-sans text-sm font-normal leading-normal text-gray-700 antialiased opacity-75">
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full bg-white rounded-xl p-5">
                <h2 class="text-lg text-center font-bold mb-4">Permohonan Peminjaman Barang/Lisensi</h2>
                <form id="loanRequestForm" action="{{ route('dashboard.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <!-- Input tersembunyi untuk ID user -->
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                    <!-- Input tersembunyi untuk Tanggal Pengajuan -->
                    <input type="hidden" name="tanggal_pengajuan" value="{{ now()->format('Y-m-d') }}">

                    <!-- Input Item yang dipinjam dalam bentuk array -->
                    <input type="hidden" id="item_details_id" name="items[0][item_details_id]">

                    <div class="mb-4">
                        <label for="quantity" class="block text-sm font-medium text-gray-700">Jumlah Barang</label>
                        <input type="number" id="quantity" name="items[0][quantity]" required min="1"
                            class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500"
                            placeholder="Masukkan jumlah barang">
                    </div>

                    <div class="mb-4">
                        <label for="durasi_peminjaman" class="block text-sm font-medium text-gray-700">Durasi Peminjaman
                            (hari)</label>
                        <input type="number" id="durasi_peminjaman" name="durasi_peminjaman" required min="1"
                            class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500"
                            placeholder="Masukkan durasi peminjaman">
                    </div>

                    <div class="mb-4">
                        <label for="alasan_peminjaman" class="block text-sm font-medium text-gray-700">Alasan
                            Peminjaman</label>
                        <textarea id="alasan_peminjaman" name="alasan_peminjaman" required
                            class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500"
                            rows="3" placeholder="Masukkan alasan peminjaman"></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="berkas_pendukung" class="block text-sm font-medium text-gray-700">Upload Berkas
                            Pendukung</label>
                        <input type="file" id="berkas_pendukung" name="berkas_pendukung"
                            accept=".pdf"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500">
                        <p> Hanya mendukung file pdf</p>
                    </div>

                    <div class="flex justify-center">
                        <button type="button" class="mr-2 px-4 py-2 bg-gray-300 rounded-md"
                            onclick="closeModal()">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Ajukan</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <!-- Modal Alert -->
    <div id="alertModal" class="fixed inset-0 z-50 hidden bg-gray-800 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg p-6 w-96">
            <h2 class="text-lg font-bold mb-4">Peringatan</h2>
            <p id="alertMessage" class="text-gray-800"></p>
            <div class="flex justify-end mt-4">
                <button type="button" class="px-4 py-2 bg-blue-600 text-white rounded-md"
                    onclick="closeAlertModal()">Tutup</button>
            </div>
        </div>
    </div>

    <script>
        function openModal(button) {
            // Ambil data dari atribut data
            const itemId = button.getAttribute('data-item-id');
            const itemName = button.getAttribute('data-item-name');
            const itemImage = button.getAttribute('data-item-image');
            const itemType = button.getAttribute('data-item-type');
            const itemBrand = button.getAttribute('data-item-brand');
            const itemCategory = button.getAttribute('data-item-category');
            const itemLocation = button.getAttribute('data-item-location');
            const itemVendor = button.getAttribute('data-item-vendor');
            const itemStatus = button.getAttribute('data-item-status');
            const availableQuantity = button.getAttribute('data-available-quantity'); // Ambil jumlah tersedia

            // Set nilai ke elemen modal
            document.getElementById('item_details_id').value = itemId;
            document.getElementById('itemName').innerText = itemName;
            document.getElementById('itemType').innerText = itemType;
            document.getElementById('itemBrand').innerText = itemBrand;
            document.getElementById('itemCategory').innerText = itemCategory;
            document.getElementById('itemLocation').innerText = itemLocation;
            document.getElementById('itemVendor').innerText = itemVendor;
            document.getElementById('itemStatus').innerText = itemStatus;
            document.getElementById('itemImage').src = itemImage;
            document.getElementById('itemAvailableQuantity').innerText = availableQuantity + " pcs";

            console.log(" . json_encode($itemImage) . ");

            // Set jumlah maksimum pada input
            const quantityInput = document.getElementById('quantity');
            quantityInput.setAttribute('max', availableQuantity); // Set atribut max
            quantityInput.value = ''; // Reset nilai input

            // Tampilkan modal
            document.getElementById('loanRequestModal').classList.remove('hidden');
        }

        // Tambahkan event listener untuk validasi input jumlah barang
        document.getElementById('quantity').addEventListener('input', function () {
            const maxQuantity = this.getAttribute('max');
            if (this.value > maxQuantity) {
                showAlertModal(`Jumlah yang dapat dipinjam maksimal adalah ${maxQuantity} pcs.`);
                this.value = maxQuantity; // Reset nilai input ke max
            }
        });

        function showAlertModal(message) {
            document.getElementById('alertMessage').innerText = message; // Set pesan alert
            document.getElementById('alertModal').classList.remove('hidden'); // Tampilkan modal alert
        }

        function closeAlertModal() {
            document.getElementById('alertModal').classList.add('hidden'); // Sembunyikan modal alert
        }

        function closeModal() {
            // Sembunyikan modal peminjaman
            document.getElementById('loanRequestModal').classList.add('hidden');
        }
    </script>

    <!-- Modal Keranjang -->
    <div id="cartModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-50">
        <div class="bg-white rounded-lg p-5 w-2/3">
            <h2 class="text-lg text-center text-red-500 font-bold mb-4">Keranjang Peminjaman (Fitur Ini Belum Tersedia
                Saat Ini)</h2>

            <!-- Daftar Item dalam Keranjang -->
            <div id="cartItems">
                <table class="w-full border-collapse border border-gray-200">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border p-2">Nama Item</th>
                            <th class="border p-2">Jumlah</th>
                            <th class="border p-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="cartItemList">
                        <!-- Data keranjang akan di-load melalui JavaScript -->
                    </tbody>
                </table>
            </div>

            <!-- Form Permohonan Peminjaman -->
            <form id="loanForm" action="{{ route('storefromcart') }}" method="POST" enctype="multipart/form-data"
                class="opacity-50 bg-gray-100 border-gray-500 pointer-events-none rounded-xl p-3 mt-2">
                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                <input type="hidden" name="tanggal_pengajuan" value="{{ now()->format('Y-m-d') }}">

                <div class="mt-4">
                    <label class="block text-sm font-semibold">Durasi Peminjaman (hari)</label>
                    <input type="number" name="durasi_peminjaman" class="w-full border rounded p-2" required min="1">
                </div>

                <div class="mt-2">
                    <label class="block text-sm font-semibold">Alasan Peminjaman</label>
                    <textarea name="alasan_peminjaman" class="w-full border rounded p-2" required></textarea>
                </div>

                <div class="mt-2">
                    <label class="block text-sm font-semibold">Berkas Pendukung (Opsional)</label>
                    <input type="file" name="berkas_pendukung" class="w-full border rounded p-2">
                </div>

                <input type="hidden" name="items" id="cartItemsInput">

                <!-- Tombol Submit -->
                <div class="mt-4 flex justify-between">

                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Buat Permohonan</button>
                </div>
            </form>

            <button type="button" onclick="closeCartModal()"
                class="bg-red-500 text-white px-4 py-2 rounded-xl mt-2">Tutup</button>
        </div>
    </div>


    <!-- JavaScript untuk Menampilkan & Memproses Keranjang -->
    <script>
        function openCartModal() {
            document.getElementById('cartModal').classList.remove('hidden');
            loadCartItems(); // Memuat item keranjang

            // Tambahkan console log untuk memeriksa saat modal dibuka
            console.log("Modal Keranjang Dibuka");
        }
        document.addEventListener('DOMContentLoaded', function () {
            loadCartItems();
        });

        // Fungsi untuk Memuat Item dari Keranjang
        function loadCartItems() {
            const cartItems = @json(session('cart', [])); // Mengambil data dari session

            const cartItemList = document.getElementById('cartItemList');
            cartItemList.innerHTML = ''; // Kosongkan daftar item

            // Loop melalui item di keranjang dan tambahkan ke tabel
            for (const [itemId, item] of Object.entries(cartItems)) {
                const row = document.createElement('tr');
                row.innerHTML = `
            <td class="border p-2">${item.name}</td>
            <td class="border p-2">${item.quantity}</td>
            <td class="border p-2">
            <button onclick="removeFromCart('${itemId}')" class="text-red-500">Hapus</button>
            </td>
        `;
                cartItemList.appendChild(row);
            }
        }

        // Fungsi untuk Menghapus Item dari Keranjang
        function removeFromCart(itemId) {
            fetch(`/cart/remove/${itemId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        loadCartItems(); // Muat ulang item keranjang
                    }
                });
        }

        // Fungsi untuk Menutup Modal
        function closeCartModal() {
            document.getElementById('cartModal').classList.add('hidden'); // Sembunyikan modal
        }
    </script>

</x-user-layout-template>