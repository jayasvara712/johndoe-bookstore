<?php

use App\Http\Controllers\BooksController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [BooksController::class, 'index']);
Route::get('/top_authors', [BooksController::class, 'topAuthors']);
Route::get('/insert_rating', [BooksController::class, 'insertRating']);
Route::get('/select_book/{id}', [BooksController::class, 'select_book']);
Route::post('/save', [BooksController::class, 'storeRating']);
