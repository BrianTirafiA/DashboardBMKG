<?php

namespace App\Services;

use App\Models\User;

interface UserService
{
    public function login(string $user, string $password): ?User;
}
