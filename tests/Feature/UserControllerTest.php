<?php

namespace Tests\Feature;

use App\Models\User;
use App\Service\Implement\UserServiceImpl;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    private UserServiceImpl $userService;
    protected function setUp(): void
    {
        parent::setUp();
        DB::delete("DELETE FROM users");
        $this->userService = $this->app->make(UserServiceImpl::class);
    }
    public function testViewLogin()
    {
        $this->seed(UserSeeder::class);

        $this->get('/login')
            ->assertStatus(200);
    }

    public function testLogin()
    {
        $this->seed(UserSeeder::class);
        $this->post('/login', [
            'email' => 'admin@example.com',
            'password' => 'root'
        ])->assertRedirect('/');
    }

    public function testLogout()
    {
        $this->seed(UserSeeder::class);
        $this->withSession([
            "email" => "admin@example.com"
        ])->post("/logout")
            ->assertRedirect("/")
            ->assertSessionMissing("user");
    }
}
