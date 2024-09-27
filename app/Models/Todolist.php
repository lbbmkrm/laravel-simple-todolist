<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todolist extends Model
{
    protected $keyType = "string";
    public $incrementing = false;

    protected $fillable = [
        'id',
        'todo',
        'description'
    ];
}
