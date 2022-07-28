<?php

namespace App\Exports;

use App\Models\Book;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromQuery;

class BooksExport implements WithHeadings, WithMapping, FromQuery
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function query()
    {
        return Book::query();
    }

    public function map($book): array
    {
        return [
            $book->title,
            $book->author,
            $book->content,
            $book->rate,
            $book->img,
            $book->audio,
            $book->file,
            $book->category->title,
            $book->created_at,
        ];
    }

    public function headings(): array
    {
        //Put Here Header Name That you want in your excel sheet 
        return [
            'Title',
            'Author',
            'Content',
            'Rate',
            'Cover',
            'Audio',
            'File',
            'Category',
            'created_at',
        ];
    }
}
