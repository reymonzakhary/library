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
    protected function search($query, $value ,$columns = null)
    { 
        // search logic...
        $query = BookCloud::query();
        $columns = ['title', 'author', 'content'];
        foreach($columns as $column){
        $query->orWhere($column, 'LIKE', '%' . $value . '%')
              ->orWhereHas('category', function($q) use ($value, $column)
        {
            $q->where($column, 'LIKE', '%'.$value.'%');
        });
        }
        return $query->get();
    }

}

