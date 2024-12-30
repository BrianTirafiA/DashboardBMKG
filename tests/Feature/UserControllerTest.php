<?php

namespace Tests\Feature;

use App\Http\Controllers\UserController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function testLoginPage(): void
    {
        $this->get('/login')
         ->assertSeeText("Login");
    }

    public function testLoginSuccess()
    {
        $this->post('/login', [
         "user" => "test",
         "password" => "test123"
        ])->assertRedirect("/")
        ->assertSessionHas("user", "test");
    }

    public function testLoginValidateError()
    {
        $this->post("/login", [])
        ->assertSeeText("Both username and password is required");
    }

    public function testLoginFail()
    {
        $this->post('/login', [
         'user' => "salah",
         "password" => "salah"
        ])->assertSeeText("Username or password is incorrect");;
    }
}
