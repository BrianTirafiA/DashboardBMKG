<?php  
  
namespace Database\Seeders;  
  
use Illuminate\Database\Seeder;  
use App\Models\ItemStatus;  
  
class StatusesTableSeeder extends Seeder  
{    
    public function run()  
    {  
        ItemStatus::create([  
            'name_status' => 'Available',  
            'description_status' => 'Barang/Lisensi/Layanan dapat dipinjam dan diajukan permohonan',  
        ]);  
  
        ItemStatus::create([  
            'name_status' => 'Maintetance',  
            'description_status' => 'Barang/Lisensi/Layanan sedang dalam proses perbaikan',  
        ]);  

        ItemStatus::create([  
            'name_status' => 'Not Available',  
            'description_status' => 'Barang/Lisensi/Layanan sudah tidak tersedia lagi',  
        ]);  
  
    }  
}  
