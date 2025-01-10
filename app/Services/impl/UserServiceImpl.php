<?php

namespace App\Services\Impl;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Support\Facades\Hash;

class UserServiceImpl implements UserService
{
    public function login(string $user, string $password): ?User
    {
        $userRecord = User::where('name', $user)->first();

        if (!$userRecord || !Hash::check($password, $userRecord->password)) {
            return null;
        }

        return $userRecord;
    }

    public function register(array $data): User  
    {  
        return User::create([  
            'name' => $data['user'],  
            'email' => $data['email'],  
            'password' => Hash::make($data['password']),  
            'role' => 'pending', // Set role sesuai kebutuhan  
        ]);  
    }  
}
