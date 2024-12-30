<?php

namespace Tests\Feature;

use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class userServiceTest extends TestCase
{
    private UserService $userService;
    protected function setUp():void
    {
        parent::setUp();

        $this->userService = $this->app->make(UserService::class);
    }

    public function testSample()
    {
        self::assertTrue(true);
    }

    public function testLogin()
    {
        self::assertTrue($this->userService->login("test","test123"));
    }

    public function testSalahLogin()
    {
        self::assertFalse($this->userService->login("test99","test123"));
    }

    public function testSalahPass()
    {
        self::assertFalse($this->userService->login("test","test"));
    }

}
