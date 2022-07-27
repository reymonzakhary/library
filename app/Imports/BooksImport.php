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
        if($row['category_id'] != Null)
        {
            $category = Category::where('title', $row['category_id'])->first()->id;
        }
        return new Book([
            //
            'title' => isset($row['title']) ? $row['title'] : 'didnt work',
            'author' => isset($row['author']) ? $row['author'] : 'didnt work',
            'content' => isset($row['content']) ? $row['content'] : 'didnt work',
            'category_id' => isset($category) ? $category: '1',
        ]);
    }
}
