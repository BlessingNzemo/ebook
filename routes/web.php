<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ReviewController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('books', BookController::class);

Route::resource('books.reviews', ReviewController::class)->shallow();

// OU si vous préférez définir les routes manuellement :
Route::get('/books/{book}/reviews/create', [ReviewController::class, 'create'])->name('books.reviews.create');
Route::post('/books/{book}/reviews', [ReviewController::class, 'store'])->name('books.reviews.store');
