<?php

namespace App\Http\Controllers;

use App\Service\Implement\TodolistServiceImpl;
use Illuminate\Http\Request;

class TodolistController extends Controller
{
    private TodolistServiceImpl $todolistService;
    public function __construct(TodolistServiceImpl $todolistServiceImpl)
    {
        $this->todolistService = $todolistServiceImpl;
    }

    public function index(Request $request)
    {
        $todolist = $this->todolistService->getTodo();
        return response()->view('todolist.index', [
            'tittle' => 'Todolist',
            'todo' => $todolist,
        ]);
    }

    public function save(Request $request)
    {
        $id = uniqid();
        $todo = $request['todo'];
        $desc = $request['description'];


        //validasi
        $request->validate([
            'id' => 'required|unique',
            'todo' => 'required',
            'description' => 'string'
        ]);

        //save todo
        $this->todolistService->saveTodo($id, $todo, $desc);

        return redirect()->action(TodolistController::class, 'index');
    }

    public function removeTodo(Request $request)
    {
        $this->todolistService->removeTodo($request['id']);
        return redirect()->action(TodolistController::class, 'index');
    }
}
