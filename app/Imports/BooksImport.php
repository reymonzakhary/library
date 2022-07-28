<?php

namespace App\Imports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Category;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class BooksImport implements ToModel, WithHeadingRow
{


    public function model(array $row)
    {
        if($row['category'] != Null)
        {
            $category = Category::where('title','LIKE' ,$row['category'])->first()->id;
        }
        return new Book([
            //
            'title' => isset($row['title']) ? $row['title'] : '',
            'author' => isset($row['author']) ? $row['author'] : '',
            'content' => isset($row['content']) ? $row['content'] : '',
            'category_id' => isset($category) ? $category: '1',
        ]);
    }
}
