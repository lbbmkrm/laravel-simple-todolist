<?php

namespace App\Service\Implement;

use App\Models\Todolist;
use App\Service\TodolistService;

class TodolistServiceImpl implements TodolistService
{
    public function saveTodo(string $id, string $todo): void
    {
        $todo = new Todolist([
            'id' => $id,
            'todo' => $todo,
        ]);

        $todo->save();
    }

    public function getTodo(): array
    {
        return Todolist::query()->get()->toArray();
    }

    public function removeTodo(string $id): void
    {
        $todo = Todolist::query()->find($id);
        $todo->delete();
    }
}
