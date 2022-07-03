<?php

namespace App\Traits;

use App\Models\BookCloud;

trait Searchable
{
    /**
     * Scope a query to search for term in the attributes
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function scopeSearch($query, $request ,$columns = null)
    { 
        // search logic...
        $query = BookCloud::query();
        $columns = ['title', 'author', 'content'];
        foreach($columns as $column){
        $query->orWhere($column, 'LIKE', '%' . $request->value . '%')
              ->orWhereHas('category', function($q) use ($request, $column)
        {
            $q->where($column, 'LIKE', '%'.$request->value.'%');
        });
        }
        return $query->get();
    }

}

