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
    }  
}  
