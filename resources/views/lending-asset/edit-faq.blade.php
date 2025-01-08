   <!-- resources/views/your-view.blade.php -->
   <x-lend-layout-template>
       <div class="">
           <div class="me-7 mb-9 mt-1">
               @php
                   // Data default jika tidak ada data yang diambil
                   $defaultData = [];
                   for ($i = 1; $i <= 10; $i++) {
                       $defaultData[] = [
                           'member' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam enim ante, efficitur ac sagittis vel, faucibus in ligula. Vivamus pharetra commodo est, at faucibus nulla mattis id. Cras euismod eros ornare magna interdum sodales. Vestibulum feugiat ex eget ultricies tincidunt. Cras eu nulla in felis porttitor posuere. Integer quis orci in libero finibus dictum vitae at lorem. Curabitur ornare aliquam placerat. Morbi mattis leo nulla, sit amet faucibus sem varius sed. Pellentesque maximus gravida mauris, et ornare metus maximus a. Fusce bibendum ullamcorper enim, eget ultricies orci consectetur facilisis. Vestibulum quis nunc placerat ex faucibus condimentum non at ante. Morbi dapibus orci et feugiat molestie. Morbi id ullamcorper risus.' . $i,
                           'function' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam enim ante, efficitur ac sagittis vel, faucibus in ligula. Vivamus pharetra commodo est, at faucibus nulla mattis id. Cras euismod eros ornare magna interdum sodales. Vestibulum feugiat ex eget ultricies tincidunt. Cras eu nulla in felis porttitor posuere. Integer quis orci in libero finibus dictum vitae at lorem. Curabitur ornare aliquam placerat. Morbi mattis leo nulla, sit amet faucibus sem varius sed. Pellentesque maximus gravida mauris, et ornare metus maximus a. Fusce bibendum ullamcorper enim, eget ultricies orci consectetur facilisis. Vestibulum quis nunc placerat ex faucibus condimentum non at ante. Morbi dapibus orci et feugiat molestie. Morbi id ullamcorper risus. ' . $i,
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
                       ['key' => 'member', 'title' => 'Pertanyaan'],
                       ['key' => 'function', 'title' => 'Jawaban'],

                   ];
               @endphp

               <x-table :title="'Edit Frequently Asked Questions.'" :description="'Halaman untuk mengedit FAQ. Masukkan pertanyaan dan jawaban, serta lihat tampilan pada pengguna'" :columns="$columns" :data="$data" />
           </div>

       </div>
   </x-lend-layout-template>
