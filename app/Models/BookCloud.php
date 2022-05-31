<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookCloud extends Model
{

    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'author',
        'rate',
        'totalpages',
        'img',
        'audio',
        'categories',
        'tags',
        'file',
    ];
}
