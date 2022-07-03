<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Searchable;

class BookCloud extends Model
{

    use HasFactory;
    use Searchable;

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

    public function scopeSearch($value)
    {
        return 'okay';
        return $value;
    }
}
