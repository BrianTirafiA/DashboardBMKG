<?php

namespace App\Services\impl;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Support\Facades\Hash;

class UserServiceImpl implements UserService
{
    // private array $users = [
    //     "test" => "test123"
    // ];

    function login(string $user, string $password): bool{
        // if(!isset($this->users[$user])){
        //     return false;
        // }

        // $correctpass = $this ->users[$user];
        // return $password==$correctpass;

        $userRecord = User::where('name', $user)->first();

        if (!$userRecord) {
            return false;
        }

        return Hash::check($password, $userRecord->password);
    }
}