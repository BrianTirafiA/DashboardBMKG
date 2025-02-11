<?php  
  
namespace Database\Seeders;  
  
use App\Models\ItemCategory;
use Illuminate\Database\Seeder;  
  
class CategoriesTableSeeder extends Seeder  
{  
    /**  
     * Run the database seeds.  
     *  
     * @return void  
     */  
    public function run()  
    {  
        ItemCategory::create([  
            'name_category' => 'Software Lisence',  
            'description_category' => 'Dapat dipinjam dalam batas waktu tertentu',  
        ]);  
  
        ItemCategory::create([  
            'name_category' => 'Computer Hardware',  
            'description_category' => 'Dapat dipinjam dalam batas waktu tertentu',  
        ]);  

        ItemCategory::create([  
            'name_category' => 'Layanan',  
            'description_category' => 'Dapat Mengajukan Permohonan untuk Pengaktifan layanan',  
        ]);  
  
        // Tambahkan lebih banyak data sesuai kebutuhan  
    }  
}  
