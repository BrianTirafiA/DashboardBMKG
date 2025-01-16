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
            'description_category' => 'Deskripsi Kategori A',  
        ]);  
  
        ItemCategory::create([  
            'name_category' => 'Computer Hardware',  
            'description_category' => 'Deskripsi Kategori B',  
        ]);  
  
        // Tambahkan lebih banyak data sesuai kebutuhan  
    }  
}  
