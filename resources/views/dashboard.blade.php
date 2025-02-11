<!DOCTYPE html>
<html lang="en" class="h-full bg-[#f0f6fb]">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Asset Management System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="h-full">

    <!-- UI Line -->
    <div class="min-h-full">
        <x-navbar-admin/>

    <section class="bg-white h-full min-h-screen">
    <div class="py-8 px-4 mx-auto lg:py-16 lg:px-40">
        <div class="mx-auto max-w-screen-md text-center mb-8 lg:mb-12">
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900">Selamat Datang {{ session('fullname') }}  </h2>
            <p class="mb-5 font-light sm:text-xl dark:text-gray-900">Apa yang akan dikerjakan hari ini?</p>
        </div>
        <div class="space-y-8 lg:grid lg:grid-cols-4 sm:gap-6 xl:gap-10 lg:space-y-0">

            <div class="flex flex-col p-6 min-w-lg text-center text-gray-900 bg-white rounded-xl border border-gray-100 shadow dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white">
                <img class="h-auto w-full -p-6 rounded-xl mb-5" src="{{ asset('assets/icon-AWSQC.webp') }}" alt="Icon-QC">
                <h3 class="mb-3 text-2xl font-semibold">AWS QC</h3>
                <p class="font-light text-gray-500 sm:text-lg dark:text-gray-400">Quality Control untuk alat AWS Center <br/> Direktorat Data dan Komputasi</p>
                
                <div class="mt-3">    
                    <button type="button" onclick="window.location.href='qcdashboard'" class="w-full shadow-xl py-2.5 px-4 text-sm font-semibold rounded-xl text-white bg-blue-600 hover:bg-blue-700 focus:outline-none">      
                        Buka Layanan      
                    </button>  
                </div> 
            </div>

            <div class="flex flex-col p-6 min-w-lg text-center text-gray-900 bg-white rounded-xl border border-gray-100 shadow dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white">
                <img class="h-auto w-full -p-6 rounded-xl mb-5" src="{{ asset('assets/icon-server.webp') }}" alt="Icon-Server">    
                <h3 class="mb-3 text-2xl font-semibold">Server Room Control</h3>
                <p class="font-light text-gray-500 sm:text-lg dark:text-gray-400">Kelola Pemiliharaan Ruang Server <br/> Direktorat Data dan Komputasi</p>
                <div class="mt-3">    
                    <button type="button" onclick="window.location.href='itasset/dashboard'" class="w-full shadow-xl py-2.5 px-4 text-sm font-semibold rounded-xl text-white bg-blue-600 hover:bg-blue-700 focus:outline-none">      
                        Buka Layanan      
                    </button>  
                </div> 
            </div>

            <div class="flex flex-col p-6  min-w-lg text-center text-gray-900 bg-white rounded-xl border border-gray-100 shadow dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white">
                <img class="h-auto w-full -p-6 rounded-xl mb-5" src="{{ asset('assets/icon-peminjaman.webp') }}" alt="Icon-peminjaman">
                <h3 class="mb-3 text-2xl font-semibold">Peminjaman Asset</h3>
                <p class="font-light text-gray-500 sm:text-lg dark:text-gray-400">Kelola Asset dan Lisensi <br/> Direktorat Data dan Komputasi</p>
                <div class="mt-3">    
                    <button type="button" onclick="window.location.href='lendasset/dashboard'" class="w-full shadow-xl py-2.5 px-4 text-sm font-semibold rounded-xl text-white bg-blue-600 hover:bg-blue-700 focus:outline-none">      
                        Buka Layanan     
                    </button>  
                </div> 
            </div>

            <div class="flex flex-col p-6  min-w-lg text-center text-gray-900 bg-white rounded-xl border border-gray-100 shadow dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white">
                <img class="h-auto w-full -p-6 rounded-xl mb-5" src="{{ asset('assets/icon-pengguna.webp') }}" alt="Icon-peminjaman">
                <h3 class="mb-3 text-2xl font-semibold">Pengguna & Unit Kerja</h3>
                <p class="font-light text-gray-500 sm:text-lg dark:text-gray-400">Kelola Data Pengguna dan <br/> Unit Kerja Terdaftar</p>
                <div class="mt-3">    
                    <button type="button" onclick="window.location.href='users'" class="w-full shadow-xl py-2.5 px-4 text-sm font-semibold rounded-xl text-white bg-blue-600 hover:bg-blue-700 focus:outline-none">      
                        Lihat Data Pengguna     
                    </button>  
                    <button type="button" onclick="window.location.href='unitkerja'" class="w-full mt-4 shadow-xl py-2.5 px-4 text-sm font-semibold rounded-xl text-white bg-blue-600 hover:bg-blue-700 focus:outline-none">      
                        Lihat Data Unit Kerja    
                    </button> 
                </div> 
            </div>
        </div>
    </div>
    </section>

    <x-footer/>

</body>