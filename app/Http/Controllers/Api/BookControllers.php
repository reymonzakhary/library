<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Http\Resources\BookResource;

class BookControllers extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return BookResource::collection(Book::paginate(10));
    }

    public function show(Book $id)
    {
        return new BookResource($id);
    }

}
