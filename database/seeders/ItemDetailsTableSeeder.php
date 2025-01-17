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
                'nama_item' => 'Item A',  
                'type_item' => 'Tipe 1',  
                'brand_item_id' => 1, // Pastikan ID ini ada di tabel item_brands  
                'tanggal_pengadaan' => '2025-01-01',  
                'nama_vendor' => 'Vendor A',  
                'jumlah_item' => 100,  
                'kategori_item_id' => 1, // Pastikan ID ini ada di tabel item_categories  
                'status_item_id' => 1, // Pastikan ID ini ada di tabel item_statuses  
                'lokasi_item_id' => 1, // Pastikan ID ini ada di tabel item_locations  
                'created_at' => now(),  
                'updated_at' => now(),  
            ],  
            [  
                'nama_item' => 'Item B',  
                'type_item' => 'Tipe 2',  
                'brand_item_id' => 2, // Pastikan ID ini ada di tabel item_brands  
                'tanggal_pengadaan' => '2025-01-02',  
                'nama_vendor' => 'Vendor B',  
                'jumlah_item' => 200,  
                'kategori_item_id' => 2, // Pastikan ID ini ada di tabel item_categories  
                'status_item_id' => 2, // Pastikan ID ini ada di tabel item_statuses  
                'lokasi_item_id' => 2, // Pastikan ID ini ada di tabel item_locations  
                'created_at' => now(),  
                'updated_at' => now(),  
            ],  
            [  
                'nama_item' => 'Item C',  
                'type_item' => 'Tipe 3',  
                'brand_item_id' => 3, // Pastikan ID ini ada di tabel item_brands  
                'tanggal_pengadaan' => '2025-01-03',  
                'nama_vendor' => 'Vendor C',  
                'jumlah_item' => 150,  
                'kategori_item_id' => 1, // Pastikan ID ini ada di tabel item_categories  
                'status_item_id' => 1, // Pastikan ID ini ada di tabel item_statuses  
                'lokasi_item_id' => 3, // Pastikan ID ini ada di tabel item_locations  
                'created_at' => now(),  
                'updated_at' => now(),  
            ],  
            // Tambahkan lebih banyak data sesuai kebutuhan  
        ]);  
    }  
}  
