<?php  
  
namespace Database\Seeders;  
  
use Illuminate\Database\Seeder;  
use Illuminate\Support\Facades\DB;  
  
class ItemBrandsTableSeeder extends Seeder  
{  
    /**  
     * Run the database seeds.  
     *  
     * @return void  
     */  
    public function run()  
    {  
        DB::table('item_brands')->insert([  
            [  
                'name_brand' => 'Brand A',  
                'origin_brand' => 'Indonesia',  
                'description_brand' => 'Brand A adalah brand terkemuka di Indonesia.',  
                'created_at' => now(),  
                'updated_at' => now(),  
            ],  
            [  
                'name_brand' => 'Brand B',  
                'origin_brand' => 'Jepang',  
                'description_brand' => 'Brand B terkenal dengan produk berkualitas tinggi.',  
                'created_at' => now(),  
                'updated_at' => now(),  
            ],  
            [  
                'name_brand' => 'Brand C',  
                'origin_brand' => 'Amerika',  
                'description_brand' => 'Brand C memiliki inovasi yang luar biasa.',  
                'created_at' => now(),  
                'updated_at' => now(),  
            ],  
            // Tambahkan lebih banyak data sesuai kebutuhan  
        ]);  
    }  
}  
