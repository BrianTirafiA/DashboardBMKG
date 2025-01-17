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
            'description_status' => 'Deskripsi Status A',  
        ]);  
  
        ItemStatus::create([  
            'name_status' => 'On Going',  
            'description_status' => 'Deskripsi Status B',  
        ]);  

        ItemStatus::create([  
            'name_status' => 'Maintetance',  
            'description_status' => 'Deskripsi Status B',  
        ]);  

        ItemStatus::create([  
            'name_status' => 'Out of Stock',  
            'description_status' => 'Deskripsi Status B',  
        ]);  

        ItemStatus::create([  
            'name_status' => 'Not Available',  
            'description_status' => 'Deskripsi Status B',  
        ]);  
  
    }  
}  
