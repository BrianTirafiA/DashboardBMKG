<?php  
  
namespace Database\Seeders;  
  
use Illuminate\Database\Seeder;  
use Illuminate\Support\Facades\DB;  
  
class ItemDetailsTableSeeder extends Seeder  
{  
    /**  
     * Run the database seeds.  
     *  
     * @return void  
     */  
    public function run()  
    {  
        DB::table('item_details')->insert([  
            [  
                'nama_item' => 'ArcGis',  
                'type_item' => 'Lisensi Terbatas',  
                'brand_item_id' => 1, // Pastikan ID ini ada di tabel item_brands  
                'tanggal_pengadaan' => '2025-01-01',  
                'nama_vendor' => 'ESRI Indonesia',  
                'jumlah_item' => 6,  
                'description' => 'Lisensi dibatasi waktu sesuai permintaan peminjaman',  
                'kategori_item_id' => 1, // Pastikan ID ini ada di tabel item_categories  
                'status_item_id' => 1, // Pastikan ID ini ada di tabel item_statuses  
                'lokasi_item_id' => 1, // Pastikan ID ini ada di tabel item_locations  
            ],  
            [  
                'nama_item' => 'Map Server',  
                'type_item' => 'API',  
                'brand_item_id' => 2,  
                'tanggal_pengadaan' => '2025-01-01',  
                'nama_vendor' => 'Pusat Database',  
                'jumlah_item' => 1,  
                'description' => 'Permohonan API Map Server',  
                'kategori_item_id' => 3, 
                'status_item_id' => 1,  
                'lokasi_item_id' => 1, 
            ], 
            [  
                'nama_item' => 'BMKGSoft',  
                'type_item' => 'API',  
                'brand_item_id' => 2,  
                'tanggal_pengadaan' => '2025-01-01',  
                'nama_vendor' => 'Pusat Database',  
                'jumlah_item' => 1,  
                'description' => 'Permohonan API BMKGSoft',  
                'kategori_item_id' => 3, 
                'status_item_id' => 1,  
                'lokasi_item_id' => 1, 
            ], 
            [  
                'nama_item' => 'AWSCenter',  
                'type_item' => 'API',  
                'brand_item_id' => 2,  
                'tanggal_pengadaan' => '2025-01-01',  
                'nama_vendor' => 'Pusat Database',  
                'description' => 'Permohonan API AWSCenter',  
                'jumlah_item' => 1,  
                'kategori_item_id' => 3, 
                'status_item_id' => 1,  
                'lokasi_item_id' => 1, 
            ], 
            [  
                'nama_item' => 'Metadata Oscar',
                'type_item' => 'API',
                'brand_item_id' => 2,
                'tanggal_pengadaan' => '2025-01-01',
                'description' => 'Permohonan API MetaOscar',  
                'nama_vendor' => 'Pusat Database', 
                'jumlah_item' => 1,
                'kategori_item_id' => 3,
                'status_item_id' => 1,
                'lokasi_item_id' => 1, 
            ], 
        ]);  
    }  
}  
