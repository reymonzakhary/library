<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookCloudController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::get('/all-books',[BookCloudController::class ,'index']);
// Route::get('/show-book/{bookCloud}',[BookCloudController::class ,'show']);
// Route::post('/create-book',[BookCloudController::class ,'store']);
// Route::put('/edit-book/{bookCloud}',[BookCloudController::class ,'update']);
// Route::delete('/delete-book/{bookCloud}',[BookCloudController::class ,'destroy']);

// route api to get all data books  from  apiResource
Route::apiResource('/books',BookCloudController::class);
