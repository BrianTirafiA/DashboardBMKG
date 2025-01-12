<?php  
  
namespace Database\Seeders;  
  
use Illuminate\Database\Seeder;  
use App\Models\Pertanyaan;  
  
class PertanyaanSeeder extends Seeder    
{    
    public function run()    
    {    
        Pertanyaan::create([    
            'question' => 'Apa itu Laravel?',    
            'answer' => 'Laravel adalah framework PHP yang digunakan untuk membangun aplikasi web dengan arsitektur MVC.'    
        ]);    
    
        Pertanyaan::create([    
            'question' => 'Bagaimana cara menginstal Laravel?',    
            'answer' => 'Anda dapat menginstal Laravel menggunakan Composer dengan perintah: composer create-project --prefer-dist laravel/laravel nama_proyek.'    
        ]);    
    
        Pertanyaan::create([    
            'question' => 'Apa itu migrasi di Laravel?',    
            'answer' => 'Migrasi adalah cara untuk mengelola skema database Anda dengan menggunakan kode PHP.'    
        ]);    
    
        Pertanyaan::create([    
            'question' => 'Apa itu Eloquent?',    
            'answer' => 'Eloquent adalah ORM (Object-Relational Mapping) yang disediakan oleh Laravel untuk berinteraksi dengan database.'    
        ]);  
  
        // Tambahkan 16 pertanyaan dan jawaban lainnya  
        Pertanyaan::create([  
            'question' => 'Apa itu Artisan?',    
            'answer' => 'Artisan adalah command-line interface yang disediakan oleh Laravel untuk menjalankan berbagai perintah.'    
        ]);  
  
        Pertanyaan::create([  
            'question' => 'Bagaimana cara membuat controller di Laravel?',    
            'answer' => 'Anda dapat membuat controller menggunakan perintah: php artisan make:controller NamaController.'    
        ]);  
  
        Pertanyaan::create([  
            'question' => 'Apa itu middleware?',    
            'answer' => 'Middleware adalah lapisan yang dapat digunakan untuk memfilter permintaan HTTP yang masuk ke aplikasi.'    
        ]);  
  
        Pertanyaan::create([  
            'question' => 'Apa itu route di Laravel?',    
            'answer' => 'Route adalah cara untuk mendefinisikan URL yang dapat diakses dalam aplikasi Laravel.'    
        ]);  
  
        Pertanyaan::create([  
            'question' => 'Bagaimana cara menggunakan session di Laravel?',    
            'answer' => 'Anda dapat menggunakan session dengan memanggil fungsi session() atau menggunakan facade Session.'    
        ]);  
  
        Pertanyaan::create([  
            'question' => 'Apa itu validation di Laravel?',    
            'answer' => 'Validation adalah proses untuk memastikan bahwa data yang diterima oleh aplikasi memenuhi kriteria tertentu.'    
        ]);  
  
        Pertanyaan::create([  
            'question' => 'Bagaimana cara mengirim email di Laravel?',    
            'answer' => 'Anda dapat mengirim email menggunakan Mail facade dan mengkonfigurasi pengaturan email di file .env.'    
        ]);  
  
        Pertanyaan::create([  
            'question' => 'Apa itu seeder?',    
            'answer' => 'Seeder adalah cara untuk mengisi database dengan data awal menggunakan kode.'    
        ]);  
  
        Pertanyaan::create([  
            'question' => 'Bagaimana cara menggunakan queue di Laravel?',    
            'answer' => 'Anda dapat menggunakan queue untuk menunda eksekusi tugas dengan menggunakan job dan queue worker.'    
        ]);  
  
        Pertanyaan::create([  
            'question' => 'Apa itu service provider?',    
            'answer' => 'Service provider adalah tempat untuk mengikat layanan ke dalam container aplikasi Laravel.'    
        ]);  
  
        Pertanyaan::create([  
            'question' => 'Bagaimana cara menggunakan event di Laravel?',    
            'answer' => 'Anda dapat menggunakan event untuk mendengarkan dan merespons peristiwa tertentu dalam aplikasi.'    
        ]);  
  
        Pertanyaan::create([  
            'question' => 'Apa itu policy di Laravel?',    
            'answer' => 'Policy adalah cara untuk mengelola otorisasi dalam aplikasi Laravel.'    
        ]);  
  
        Pertanyaan::create([  
            'question' => 'Bagaimana cara menggunakan API di Laravel?',    
            'answer' => 'Anda dapat membuat API dengan mendefinisikan route dan controller yang mengembalikan response JSON.'    
        ]);  
  
        Pertanyaan::create([  
            'question' => 'Apa itu broadcasting di Laravel?',    
            'answer' => 'Broadcasting adalah cara untuk mengirimkan data real-time ke klien menggunakan WebSockets.'    
        ]);  
  
        Pertanyaan::create([  
            'question' => 'Bagaimana cara menggunakan caching di Laravel?',    
            'answer' => 'Anda dapat menggunakan caching untuk menyimpan data sementara dan mempercepat akses data.'    
        ]);  
  
        Pertanyaan::create([  
            'question' => 'Apa itu testing di Laravel?',    
            'answer' => 'Testing adalah proses untuk memastikan bahwa aplikasi berfungsi dengan baik dan sesuai harapan.'    
        ]);  
  
        Pertanyaan::create([  
            'question' => 'Bagaimana cara menggunakan localization di Laravel?',    
            'answer' => 'Anda dapat menggunakan localization untuk mendukung berbagai bahasa dalam aplikasi.'    
        ]);  
    }    
}  
