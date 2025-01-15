<?php  
  
namespace Database\Seeders;  
  
use Illuminate\Database\Seeder;  
use App\Models\Category;  
  
class CategoriesTableSeeder extends Seeder  
{  
    /**  
     * Run the database seeds.  
     *  
     * @return void  
     */  
    public function run()  
    {  
        Category::create([  
            'nama' => 'Software Lisence',  
            'description' => 'Deskripsi Kategori A',  
        ]);  
  
        Category::create([  
            'nama' => 'Computer Hardware',  
            'description' => 'Deskripsi Kategori B',  
        ]);  
  
        // Tambahkan lebih banyak data sesuai kebutuhan  
    }  
}  
