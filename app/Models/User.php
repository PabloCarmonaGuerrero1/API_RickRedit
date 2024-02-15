<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'password',
        'idicon',
        'num_comments',
        'comments',
    ];

    // Puedes agregar relaciones u otros métodos según tus necesidades
}
