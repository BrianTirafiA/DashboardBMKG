   <!-- resources/views/your-view.blade.php -->
   <x-lend-layout-template>
       <div class="me-7 mt-1">
           @php
               // Data default jika tidak ada data yang diambil
               $defaultData = [];
               for ($i = 1; $i <= 10; $i++) {
                   $defaultData[] = [
                       'member' => 'Member ' . $i,
                       'function' => 'Function ' . $i,
                       'status' => 'Status ' . $i,
                       'employed' => 'Employed ' . $i,
                   ];
               }

               // Simulasi pengambilan data dari database
               // Ganti dengan logika pengambilan data yang sesuai
               $data = []; // Misalnya, ambil data dari database di sini

               // Jika tidak ada data, gunakan data default
               if (empty($data)) {
                   $data = $defaultData;
               }

               // Definisikan kolom
               $columns = [
                   ['key' => 'member', 'title' => 'Member'],
                   ['key' => 'function', 'title' => 'Function'],
                   ['key' => 'status', 'title' => 'Status'],
                   ['key' => 'employed', 'title' => 'Employed'],
               ];
           @endphp

           <x-table :title="'Daftar Pengguna'" :description="'Halaman untuk melihat daftar pengguna yang menggunakan layanan'" :columns="$columns" :data="$data" />
       </div>

   </x-lend-layout-template>
