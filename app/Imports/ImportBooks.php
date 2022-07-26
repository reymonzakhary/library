<?php

namespace App\Imports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportBooks implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Book([
            'title'     => $row[0],
            'author'    => $row[1],
            'content'   => $row[2],
            'category'  => $row[3],
        ]);
    }
}
