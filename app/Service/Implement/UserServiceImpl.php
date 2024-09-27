<?php

namespace App\Service\Implement;

use App\Models\User;
use App\Service\UserService;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class UserServiceImpl implements UserService
{
    public function login(string $email, string $password): bool
    {
        return Auth::attempt([
            'email' => $email,
            'password' => $password
        ]);
    }

    public function register(string $email, string $username, string $password): bool
    {
        $data = [
            'email' => $email,
            'username' => $username,
            'password' => $password
        ];


        $validateData = Validator::make($data, [
            'email' => ['required', 'email'],
            'username' => ['required', 'min:8', 'unique:users'],
            'password' => ['required', Password::min(6)->letters()->numbers()->symbols()]
        ])->validate();

        $user = new User();
        $user->email = $validateData['email'];
        $user->username = $validateData['username'];
        $user->password = Hash::make($validateData['password']);

        try {
            // Simpan user ke database
            if ($user->save()) {
                return true; // Registration successful
            }
        } catch (QueryException $e) {

            return false; // Return false jika gagal
        }
        return false;
    }
}
