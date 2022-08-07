<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\Api\BookControllers;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layout/welcome');
});

Auth::routes();
Route::view('/login', 'layout/login');

Route::group(['prefix' => '/admin'], function () {
    //books
    Route::resource('/books', BookController::class);
    Route::post('/books/search', [BookController::class, 'index'])->name('search.book');
    //excel-book-importing
    Route::get('import/file', [BookController::class, 'uploadExcelFile'])->name('upload.excel.file');
    Route::post('import/file', [BookController::class, 'importExcelFile'])->name('import.excel');
    Route::get('/download/{file}', [BookController::class, 'downloadTemplate'])->name('download.template');
    Route::get('/export/file', [BookController::class, 'exportExcelFile'])->name('export.excel');
    //categories
    Route::resource('/categories', CategoryController::class);
    //generate epub
    Route::get('/epub', [BookController::class, 'pdfConverter'])->name('convert.pdf');
    Route::post('/epub', [BookController::class, 'updateHtml'])->name('export.epub');
});

Route::group(['prefix' => '/api'], function () {
    Route::get('books', [BookControllers::class, 'index']);
    Route::get('book/{id}', [BookControllers::class, 'show']);
});
