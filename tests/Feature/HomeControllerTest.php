<?php

namespace Tests\Feature;

use App\Http\Controllers\HomeController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    public function testGuest(){
        $this->get('/')
            ->assertRedirect("/login");
    }

    //a
    public function testMember(){

        $this->withSession([
            "user" => "test"
        ])->get('/')
            ->assertRedirect("/qcdashboard");
    }
}
