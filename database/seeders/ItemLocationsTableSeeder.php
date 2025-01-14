<?php  
  
namespace Database\Seeders;  
  
use Illuminate\Database\Seeder;  
use App\Models\ItemLocation;  
  
class ItemLocationsTableSeeder extends Seeder  
{  
    /**  
     * Run the database seeds.  
     *  
     * @return void  
     */  
    public function run()  
    {  
        ItemLocation::create([  
            'nama_lokasi' => 'Ruangan DDK',  
            'alamat_lokasi' => 'Alamat A',  
            'penanggung_jawab' => 'Penanggung Jawab A',  
            'latitude' => -6.200000,  
            'longitude' => 106.816666,  
        ]);  
  
        ItemLocation::create([  
            'nama_lokasi' => 'Ruangan Server',  
            'alamat_lokasi' => 'Alamat B',  
            'penanggung_jawab' => 'Penanggung Jawab B',  
            'latitude' => -6.300000,  
            'longitude' => 106.816666,  
        ]);  
  
        // Tambahkan lebih banyak data sesuai kebutuhan  
    }  
}  
