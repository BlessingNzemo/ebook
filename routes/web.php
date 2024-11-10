<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ReviewController;

Route::get('/', function () {
    return redirect()->route('books.index');
});

Route::resource('books', BookController::class);
Route::resource('books.reviews', ReviewController::class)->shallow();

// Choisir UNE des deux options suivantes (pas les deux) :

// Option 1 : Utilisation de resource avec shallow
//Route::resource('books.reviews', ReviewController::class)->shallow();

// OU

// Option 2 : Définition manuelle des routes
// Route::get('/books/{book}/reviews/create', [ReviewController::class, 'create'])->name('books.reviews.create');
// Route::post('/books/{book}/reviews', [ReviewController::class, 'store'])->name('books.reviews.store');
// Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
// Route::get('/reviews/{review}', [ReviewController::class, 'show'])->name('reviews.show');
// Route::get('/reviews/{review}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
// Route::put('/reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');
// Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
