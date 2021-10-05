<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CommentController;

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
    return view('welcome');
});

Route::group(['prefix' => 'authors'], function () {
    Route::get('', [AuthorController::class, 'index'])->name('author.index');
    Route::get('create', [AuthorController::class, 'create'])->name('author.create');
    Route::post('store', [AuthorController::class, 'store'])->name('author.store');
    Route::get('edit/{author}', [AuthorController::class, 'edit'])->name('author.edit');
    Route::post('update/{author}', [AuthorController::class, 'update'])->name('author.update');
    Route::post('delete/{author}', [AuthorController::class, 'destroy'])->name('author.destroy');
    Route::get('show/{author}', [AuthorController::class, 'show'])->name('author.show');
    Route::get('pdf/{author}', [AuthorController::class, 'pdf'])->name('author.pdf');
});

Route::group(['prefix' => 'books'], function () {
    Route::get('', [BookController::class, 'index'])->name('book.index');
    Route::get('create', [BookController::class, 'create'])->name('book.create');
    Route::post('store', [BookController::class, 'store'])->name('book.store');
    Route::get('edit/{book}', [BookController::class, 'edit'])->name('book.edit');
    Route::post('update/{book}', [BookController::class, 'update'])->name('book.update');
    Route::post('delete/{book}', [BookController::class, 'destroy'])->name('book.destroy');
    Route::get('show/{book}', [BookController::class, 'show'])->name('book.show');
    Route::get('pdf/{book}', [BookController::class, 'pdf'])->name('book.pdf');
});

Route::group(['prefix' => 'comments'], function () {
    Route::get('', [CommentController::class, 'index'])->name('comment.index');
    Route::get('create', [CommentController::class, 'create'])->name('comment.create');
    Route::post('store', [CommentController::class, 'store'])->name('comment.store');
    Route::get('edit/{comment}', [CommentController::class, 'edit'])->name('comment.edit');
    Route::post('update/{comment}', [CommentController::class, 'update'])->name('comment.update');
    Route::post('delete/{comment}', [CommentController::class, 'destroy'])->name('comment.destroy');
    Route::get('show/{comment}', [CommentController::class, 'show'])->name('comment.show');
});

Route::get('load-data', [LoadMoreDataController::class, 'index']);
Route::post('load-data', [LoadMoreDataController::class, 'loadMoreData'])->name('load-data');





//Auth::routes(['register' => false]);


//Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');