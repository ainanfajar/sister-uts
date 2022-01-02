<?php

use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
// use App\Http\Controllers\KategoriController;
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

Route::get('/', function () {
    return view('index', ['title' => 'UTS SisPro Transaction']);
});

// Route::get('/artikel', function () {
//     return view('artikel');
// });

Route::resource('artikels', ArtikelController::class);
Route::resource('categories', CategoryController::class);
