<?php  
  
namespace Tests\Feature;  
  
use App\Http\Controllers\UserController;  
use App\Models\User;  

use Illuminate\Http\Request;  
use Tests\TestCase;  
  
class RegisterTest extends TestCase  
{  
  
    /** @test */  
    public function it_can_register_a_new_user()  
    {  
        // Buat instance UserController menggunakan app()  
        $controller = app(UserController::class);  
  
        // Simulasi data pendaftaran  
        $data = [  
            'user' => 'TestUser10',  
            'email' => 'testuser10@example.com',  
            'password' => 'password123',  
            'password_confirmation' => 'password123',  // Pastikan ini adalah password_confirmation  
        ];  
  
        // Buat request baru  
        $request = new Request($data);  
  
        // Panggil metode register secara langsung  
        $response = $controller->register($request);  
  
        // Cek apakah pengguna diarahkan ke halaman login  
        $this->assertEquals(302, $response->getStatusCode());  
    }  
  
}  
