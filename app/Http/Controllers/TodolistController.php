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
            'todolist' => $todolist,
        ]);
    }

    public function saveTodo(Request $request)
    {
        $id = uniqid();
        $todo = $request['todo'];


        //validasi
        $request->validate([
            'todo' => 'required',

        ]);

        //save todo
        $this->todolistService->saveTodo($id, $todo);

        return redirect()->route('todolist.index');
    }

    public function removeTodo(Request $request, string $id)
    {
        $this->todolistService->removeTodo($id);
        return redirect()->route('todolist.index');
    }
}
