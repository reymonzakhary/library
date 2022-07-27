<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Http\Requests\BookRequest;
use App\Imports\BooksImport;
use App\Models\Category;
use App\Services\EpubService;
use Maatwebsite\Excel\Facades\Excel;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $value)
    {
        $books = Book::with('category')->filterBy(request()->all())->search($value)->latest()->get();
        return view('books.index')->with('books', $books);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();
        return view('books.create')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookRequest $request)
    {
        //
        $book = Book::create($request->validated());
        if($request->file('file')) {
            $fileName = time().'_'.$request->file->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('uploads/files', $fileName, 'public');
            $request->file = time().'_'.$request->file->getClientOriginalName();
            $request->file_path = '/storage/' . $filePath;
        }
        if($request->file('audio')) {
            $fileName = time().'_'.$request->audio->getClientOriginalName();
            $filePath = $request->file('audio')->storeAs('uploads/audio', $fileName, 'public');
            $request->file = time().'_'.$request->audio->getClientOriginalName();
            $request->file_path = '/storage/' . $filePath;
        }
        if($request->file('img')) {
            $fileName = time().'_'.$request->img->getClientOriginalName();
            $filePath = $request->file('img')->storeAs('uploads/imgs', $fileName, 'public');
            $request->file = time().'_'.$request->img->getClientOriginalName();
            $request->file_path = '/storage/' . $filePath;
        }
        return redirect()->route('books.index')->with('success', 'book was added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
        return view('books.edit',['book' => $book]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BookRequest $request, Book $book)
    {
        //
        $book->update([
            'title' => $request->title,
            'content' => $request->content,
            'author' => $request->author,
            'rate' => $request->rate,
            'totalpages' => $request->totalpages,
            'category_id' => $request->category_id,
            'img' => $request->img,
            'audio' => $request->audio,
            'tags' => $request->tags,
            'file' => $request->file,
        ]);
        return redirect()->route('books.index')->with('success' , 'book was updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //
        $book->delete();
        return redirect()->route('books.index', ['book' => $book])->with('success', 'book was deleted');
    }

    public function convertEpub(EpubService $epub)
    {
        //
        $epubTest = $epub->convert();
        return $epubTest;   
    }

    public function convertHtml(EpubService $epub)
    {
        //
        $htmlTest = $epub->htmlConverter();
        return $htmlTest;   
    }

    public function updateHtml(EpubService $epub, Request $request)
    {
        //
        $updateHtml = $epub->chapterSeparator($request);
        return $updateHtml;   
    }

    public function uploadExcelFile ()
    {
        return view('books.uploadExcel');

    }

    public function importExcelFile (Request $request)
    {
        Excel::import(new BooksImport, $request->file('file'));
        return redirect()->route('books.index')->with('success', 'Books Imported Successfully');
    }
}
