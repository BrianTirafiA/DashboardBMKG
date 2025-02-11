<?php  
  
namespace Database\Seeders;  
  
use Illuminate\Database\Seeder;  
use App\Models\LoanRequestItem;  

class LoanRequestItemSeeder extends Seeder  
{  
    /**  
     * Run the database seeds.  
     *  
     * @return void  
     */  
    public function run()  
    {  
        // Hapus data sebelumnya jika ada  
        LoanRequestItem::truncate();  
  
        // Definisikan data untuk loan_request_id = 1  
        LoanRequestItem::create([  
            'loan_request_id' => 16,  
            'item_details_id' => 8, // ID barang pertama  
            'quantity' => 3, // Kuantitas barang pertama  
        ]);  
  
        LoanRequestItem::create([  
            'loan_request_id' => 16,  
            'item_details_id' => 9, // ID barang kedua  
            'quantity' => 2, // Kuantitas barang kedua  
        ]);  
  
        LoanRequestItem::create([  
            'loan_request_id' => 16,  
            'item_details_id' => 14, // ID barang ketiga  
            'quantity' => 1, // Kuantitas barang ketiga  
        ]);  
  
        // Definisikan data untuk loan_request_id = 2  
        LoanRequestItem::create([  
            'loan_request_id' => 17,  
            'item_details_id' => 8, // ID barang pertama  
            'quantity' => 5, // Kuantitas barang pertama  
        ]);  
  
        LoanRequestItem::create([  
            'loan_request_id' => 17,  
            'item_details_id' => 9, // ID barang kedua  
            'quantity' => 1, // Kuantitas barang kedua  
        ]);  
  
        // Definisikan data untuk loan_request_id = 3  
        LoanRequestItem::create([  
            'loan_request_id' => 18,  
            'item_details_id' => 14, // ID barang pertama  
            'quantity' => 2, // Kuantitas barang pertama  
        ]);  
  
        LoanRequestItem::create([  
            'loan_request_id' => 18,  
            'item_details_id' => 9, // ID barang kedua  
            'quantity' => 4, // Kuantitas barang kedua  
        ]);  
  
        // Definisikan data untuk loan_request_id = 4  
        LoanRequestItem::create([  
            'loan_request_id' => 19,  
            'item_details_id' => 8, // ID barang pertama  
            'quantity' => 3, // Kuantitas barang pertama  
        ]);  
  
        LoanRequestItem::create([  
            'loan_request_id' => 19,  
            'item_details_id' => 14, // ID barang kedua  
            'quantity' => 2, // Kuantitas barang kedua  
        ]);  
  
        // Definisikan data untuk loan_request_id = 5  
        LoanRequestItem::create([  
            'loan_request_id' => 20,  
            'item_details_id' => 8, // ID barang pertama  
            'quantity' => 1, // Kuantitas barang pertama  
        ]);  
  
        LoanRequestItem::create([  
            'loan_request_id' => 20,  
            'item_details_id' => 9, // ID barang kedua  
            'quantity' => 3, // Kuantitas barang kedua  
        ]);  
    }  
}  
