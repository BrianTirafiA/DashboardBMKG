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

    public function testLoginPageMember(): void
    {
        $this->withSession([
            "user" => "test"            
        ])->get('/login')
            ->assertRedirect("/home");
    }

    public function testLoginSuccess()
    {
        $this->post('/login', [
         "user" => "test",
         "password" => "test123"
        ])->assertRedirect("/home")
        ->assertSessionHas("user", "test");
    }

    public function testLoginAlready()
    {
        $this->withSession([
            "user" => "test"            
        ])->post('/login', [
            "user" => "test",
            "password" => "test123"
           ])->assertRedirect("/home");
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

    public function testLogOut(){
        $this->withSession([
            "user" => "test"            
        ])->post('/logout')
            ->assertRedirect("/login")
            ->assertSessionMissing("user");
    }

    public function testLogOutGuest(){
    
        $this->post('/logout')
            ->assertRedirect("/login");
    }
}


