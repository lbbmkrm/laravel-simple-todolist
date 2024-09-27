<?php

namespace App\Http\Controllers;

use App\Service\Implement\UserServiceImpl;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    private UserServiceImpl $userService;
    public function __construct(UserServiceImpl $userService)
    {
        $this->userService = $userService;
    }

    public function loginView(): Response
    {
        return response()->view('user.login', ['tittle' => 'Login']);
    }

    public function login(Request $request): Response
    {
        $email = $request->input('email');
        $password = $request->input('password');
        //validasi input
        $validation = Validator::make([$email, $password], [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $validation->validate();

        //login
        if ($this->userService->login(email: $email, password: $password)) {
            $request->session()->put('email', $email);
        }

        return response()->view('user.login', [
            'tittle' => 'Login',
            'error' => $validation->errors()
        ], 401);
    }

    public function resgister(Request $request): Response
    {
        $email = $request->input('email');
        $username = $request->input('username');
        $password = $request->input('password');

        if ($this->userService->register(email: $email, username: $username, password: $password)) {
            return response()->view('user.login', [
                'tittle' => 'Login',
                'success' => 'Success'
            ]);
        }

        return response()->view('user.login', [
            'tittle' => 'Login',
            'errors' => 'error'
        ]);
    }

    public function logout(Request $request): RedirectResponse
    {
        $request->session()->forget('email');
        return response()->redirectTo('/');
    }
}
