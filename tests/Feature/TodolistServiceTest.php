<?php

namespace Tests\Feature;

use App\Service\Implement\TodolistServiceImpl;
use Database\Seeders\TodolistSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class TodolistServiceTest extends TestCase
{
    private TodolistServiceImpl $todolistService;
    protected function setUp(): void
    {
        parent::setUp();
        DB::delete("DELETE FROM todolists");
        $this->todolistService = $this->app->make(TodolistServiceImpl::class);
    }

    public function testSaveTodo()
    {
        $this->todolistService->saveTodo("1", "example", "description");
        $this->assertDatabaseHas('todolists', [
            'id' => '1',
            'todo' => 'example',
            'description' => 'description'
        ]);
    }

    public function testRemoveTodo()
    {
        $this->todolistService->saveTodo("1", "example", "description");
        $this->todolistService->removeTodo('1');

        $this->assertDatabaseMissing('todolists', [
            'id' => '1',
            'todo' => 'example',
            'description' => 'description'
        ]);
    }

    public function testGetTodo()
    {
        $this->seed(TodolistSeeder::class);

        $result = $this->todolistService->getTodo();

        self::assertNotNull($result);
    }
}
