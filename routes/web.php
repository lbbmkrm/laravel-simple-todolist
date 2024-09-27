<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\LoginMiddleware;
use App\Http\Middleware\LogoutMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home']);

Route::controller(UserController::class)->group(function () {
    Route::get('/login', 'loginView')->middleware(LogoutMiddleware::class);
    Route::post('/login', 'login')->middleware(LogoutMiddleware::class);
    Route::get('/register', 'viewRegister');
    Route::post('/register', 'register');
    Route::post('/login', 'logout')->middleware(LoginMiddleware::class);
});
