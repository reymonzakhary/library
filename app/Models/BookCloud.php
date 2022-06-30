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
        'tags',
        'file',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // public function scopeFilter($query, QueryFilter $filters)
    // {
    //     return $filters->apply($query);
    // }
}
