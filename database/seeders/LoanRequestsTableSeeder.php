<?php  
  
namespace Database\Seeders;  
  
use Illuminate\Database\Seeder;  
use App\Models\LoanRequest; // Pastikan untuk mengimpor model yang benar  
use Carbon\Carbon;  
  
class LoanRequestsTableSeeder extends Seeder  
{  
    /**  
     * Run the database seeds.  
     *  
     * @return void  
     */  
    public function run()  
    {  
        LoanRequest::create([  
            'user_id' => 1, // Ganti dengan ID pengguna yang valid  
            'durasi_peminjaman' => 30,  
            'alasan_peminjaman' => 'Alasan peminjaman untuk data dummy 1',  
            'berkas_pendukung' => null,  
            'tanggal_pengajuan' => Carbon::now()->toDateString(),  
            'approval_status' => 'pending',  
            'admin_id' => null,  
            'approval_date' => null,  
            'returned_date' => null,
        ]);  
  
        LoanRequest::create([  
            'user_id' => 2, // Ganti dengan ID pengguna yang valid  
            'durasi_peminjaman' => 45,  
            'alasan_peminjaman' => 'Alasan peminjaman untuk data dummy 2',  
            'berkas_pendukung' => null,  
            'tanggal_pengajuan' => Carbon::now()->toDateString(),  
            'approval_status' => 'pending',  
            'admin_id' => null,  
            'approval_date' => null, 
            'returned_date' => null, 
        ]);  
  
        LoanRequest::create([  
            'user_id' => 3, // Ganti dengan ID pengguna yang valid  
            'durasi_peminjaman' => 15,  
            'alasan_peminjaman' => 'Alasan peminjaman untuk data dummy 3',  
            'berkas_pendukung' => null,  
            'tanggal_pengajuan' => Carbon::now()->toDateString(),  
            'approval_status' => 'pending',  
            'admin_id' => null,  
            'approval_date' => null,  
            'returned_date' => null,
        ]);  
  
        LoanRequest::create([  
            'user_id' => 4, // Ganti dengan ID pengguna yang valid  
            'durasi_peminjaman' => 20,  
            'alasan_peminjaman' => 'Alasan peminjaman untuk data dummy 4',  
            'berkas_pendukung' => null,  
            'tanggal_pengajuan' => Carbon::now()->toDateString(),  
            'approval_status' => 'pending',  
            'admin_id' => null,  
            'approval_date' => null,  
            'returned_date' => null,
        ]);  
  
        LoanRequest::create([  
            'user_id' => 5, // Ganti dengan ID pengguna yang valid  
            'durasi_peminjaman' => 10,  
            'alasan_peminjaman' => 'Alasan peminjaman untuk data dummy 5',  
            'berkas_pendukung' => null,  
            'tanggal_pengajuan' => Carbon::now()->toDateString(),  
            'approval_status' => 'pending',  
            'admin_id' => null,  
            'approval_date' => null,  
            'returned_date' => null,
        ]);  
    }  
}  
