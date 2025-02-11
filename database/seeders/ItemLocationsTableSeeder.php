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
            'nama_lokasi' => 'Online',  
            'alamat_lokasi' => 'Tidak ada alamat Fisik',  
            'penanggung_jawab' => 'Bambang Setyo Prayitno, M.Si.',  
            'latitude' => -6.1560 ,  
            'longitude' => 106.8420,  
        ]);  
        ItemLocation::create([  
            'nama_lokasi' => 'BMKG Pusat',  
            'alamat_lokasi' => 'Jl. Angkasa 1 No.2, RT.1/RW.10, Gn. Sahari Sel., Kec. Kemayoran, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10610',  
            'penanggung_jawab' => 'Prof. Dwikorita Karnawati, Ph.D.',  
            'latitude' => -6.1560 ,  
            'longitude' => 106.8420,  
        ]);  
    }  
}  
