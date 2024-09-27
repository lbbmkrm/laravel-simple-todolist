<?php

namespace Tests\Feature;

use App\Service\Implement\UserServiceImpl;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    private UserServiceImpl $userService;

    protected function setUp(): void
    {
        parent::setUp();
        DB::delete("DELETE FROM users");
        $this->userService = $this->app->make(UserServiceImpl::class);
    }

    public function testLoginSuccess()
    {
        $this->seed(UserSeeder::class);

        self::assertTrue($this->userService->login('admin@example.com', 'root'));
    }
    public function testLoginFailed()
    {
        $this->seed(UserSeeder::class);

        self::assertFalse($this->userService->login('salah@example.com', 'salah'));
    }

    public function testRegisterSuccess()
    {
        self::assertTrue($this->userService
            ->register('admin@example.com', 'administrator', Hash::make('root')));
    }

    public function testRegisterFailed()
    {
        $this->expectException(ValidationException::class);
        self::assertFalse($this->userService
            ->register('admin@example.com', '', ''));
    }
}
