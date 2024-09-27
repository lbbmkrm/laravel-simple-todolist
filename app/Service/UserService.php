<?php

namespace App\Service;

interface UserService
{
    public function login(string $email, string $password): bool;
    public function register(string $email, string $username, string $password): bool;
}
