<?php

namespace App\Utilities\Filters;

use App\Utilities\QueryFilter;
use App\Utilities\FilterContract;

class Title extends QueryFilter implements FilterContract
{
    public function handle($value): void
    {
        $this->query->orderBy($value, 'asc');
    }

}