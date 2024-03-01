<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'option',
        'email',
        'note',
        'review',
        'user_advice',
        'date',
        'advice'
    ];
    public $timestamps = false;
}
