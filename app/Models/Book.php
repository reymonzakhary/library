<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Searchable;

class Book extends Model
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

    public function scopeSearch($query, $value)
    {
        $columns = ['title', 'author', 'content'];
        foreach($columns as $column){
        $query->orWhere($column, 'LIKE', '%' . $value->value . '%')
              ->orWhereHas('category', function($q) use ($value, $column)
        {
            $q->where($column, 'LIKE', '%'.$value->value.'%');
        });   
        }
    }
}
