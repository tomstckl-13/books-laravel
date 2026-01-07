<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('welcome'));

Route::get('/dashboard', fn() => view('dashboard'))
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| Books
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/books', [BookController::class, 'listBooks'])
        ->name('books.index');

    Route::post('/books', [BookController::class, 'saveBook'])
        ->name('books.store');

    Route::get('/books/{book}/edit', [BookController::class, 'editBook'])
        ->name('books.edit');

    Route::get('/books/{book}/edit', [BookController::class, 'editBook'])
        ->name('books.edit');

    Route::patch('/books/{book}', [BookController::class, 'updateBook'])
        ->name('books.update');

    Route::delete('/books/{book}', [BookController::class, 'destroyBook'])
        ->name('books.delete');
});

/*
|--------------------------------------------------------------------------
| Authors
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/authors', [AuthorController::class, 'listAuthors'])
        ->name('authors.index');

    Route::post('/authors', [AuthorController::class, 'saveAuthor'])
        ->name('authors.store');

    Route::get('/authors/{author}/edit', [AuthorController::class, 'editAuthor'])
        ->name('authors.edit');

    Route::delete('/authors/{author}', [AuthorController::class, 'destroy'])
        ->name('authors.delete');
});

/*
|--------------------------------------------------------------------------
| Profile
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.delete');
});

require __DIR__ . '/auth.php';
