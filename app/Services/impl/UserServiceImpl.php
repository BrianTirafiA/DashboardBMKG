<?php

namespace App\Services\impl;

use App\Services\UserService;

class UserServiceImpl implements UserService
{
    private array $users = [
        "test" => "test123"
    ];

    function login(string $user, string $password): bool{
        if(!isset($this->users[$user])){
            return false;
        }

        $correctpass = $this ->users[$user];
        return $password==$correctpass;
    }
}