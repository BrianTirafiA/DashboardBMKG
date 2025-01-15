<?php  
  
namespace Database\Seeders;  
  
use Illuminate\Database\Seeder;  
use App\Models\Status;  
  
class StatusesTableSeeder extends Seeder  
{    
    public function run()  
    {  
        Status::create([  
            'nama' => 'Available',  
            'description' => 'Deskripsi Status A',  
        ]);  
  
        Status::create([  
            'nama' => 'On Going',  
            'description' => 'Deskripsi Status B',  
        ]);  

        Status::create([  
            'nama' => 'Maintetance',  
            'description' => 'Deskripsi Status B',  
        ]);  

        Status::create([  
            'nama' => 'Out of Stock',  
            'description' => 'Deskripsi Status B',  
        ]);  

        Status::create([  
            'nama' => 'Not Available',  
            'description' => 'Deskripsi Status B',  
        ]);  
  
    }  
}  
