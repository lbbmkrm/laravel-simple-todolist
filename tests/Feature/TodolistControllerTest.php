<?php

namespace Tests\Feature;

use App\Service\Implement\TodolistServiceImpl;
use Database\Seeders\TodolistSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class TodolistControllerTest extends TestCase
{
    private TodolistServiceImpl $todolistService;
    protected function setUp(): void
    {
        parent::setUp();
        DB::delete("DELETE FROM todolists");
        DB::delete("DELETE FROM users");
        $this->todolistService = $this->app->make(TodolistServiceImpl::class);
    }

    public function testIndex()
    {
        $this->seed([UserSeeder::class, TodolistSeeder::class]);
        $this->withSession(['email' => 'email'])->get('/todolist')
            ->assertStatus(200);
    }

    public function testSave()
    {
        $this->seed(UserSeeder::class);
        $this->withSession(['email' => 'admin@example.com'])
            ->post('/todolist', [
                'id' => uniqid(),
                'todo' => 'Reading',
                'description' => 'description'
            ])->assertRedirect('/todolist');
    }
}
