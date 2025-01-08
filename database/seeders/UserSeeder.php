<?php  
  
namespace Database\Seeders;  
  
use Illuminate\Database\Seeder;  
use App\Models\User;  
use Illuminate\Support\Facades\Hash;  
  
class UserSeeder extends Seeder  
{  
    /**  
     * Run the database seeds.  
     */  
    public function run(): void  
    {  
        // Buat user biasa  
        User::create([  
            'name' => 'User',   
            'email' => 'user@example.com',  
            'password' => Hash::make('password'), // Password di-hash  
            'role' => 'user',  
        ]);  
  
        // Buat admin  
        User::create([  
            'name' => 'admin',  
            'email' => 'admin@example.com',  
            'password' => Hash::make('password'), // Password di-hash  
            'role' => 'admin',  
        ]);  
    }  
}  
