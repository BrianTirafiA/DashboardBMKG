   <!-- resources/views/your-view.blade.php -->  
   <x-layout-server>  
       <h2 class="text-2xl font-semibold">Konten Utama Elhanif</h2>      
       <p>Ini adalah konten utama halaman. Anda dapat menambahkan lebih banyak informasi di sini.</p>      
       <!-- Tambahkan konten lainnya di sini -->  
       <x-table
            :title="'Member Management'" 
            :description="'Manage all the members effectively in one place.'" 
            :columns="[
                ['title' => 'Name', 'key' => 'name'],
                ['title' => 'Email', 'key' => 'email'],
                ['title' => 'Role', 'key' => 'role']
            ]" 
            :data="[
        ['name' => 'John Doe', 'email' => 'john.doe@example.com', 'role' => 'Admin'],
        ['name' => 'Jane Smith', 'email' => 'jane.smith@example.com', 'role' => 'Editor'],
    ]"
        />

   </x-layout-server>  
