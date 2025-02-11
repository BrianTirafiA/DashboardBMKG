<?php  
  
namespace Database\Seeders;  
  
use Illuminate\Database\Seeder;  
use Illuminate\Support\Facades\DB; 
use  App\Models\ItemBrand;
  
class ItemBrandsTableSeeder extends Seeder  
{  
    /**  
     * Run the database seeds.  
     *  
     * @return void  
     */  
    public function run()  
    {  
        ItemBrand::create([  
            [  
                'name_brand' => 'Esri Indonesia',  
                'origin_brand' => 'Indonesia',  
                'description_brand' => 'Perusahaan Penyedia Lisensi ArcGis di Indonesia',  
            ],   
             
        ]);  

        ItemBrand::create([  
            [  
                'name_brand' => 'Pusat Database',  
                'origin_brand' => 'Indonesia',  
                'description_brand' => 'Layanan Database yang disediakan Direktorat Data dan Komputasi',  
            ],  
        ]);  


    }  
}  
