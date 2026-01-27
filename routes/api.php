<?php

use App\Http\Controllers\RestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::delete('books/{book}', [RestController::class, 'destroy']
)->middleware(['abilities:bookmark:delete'])
    ->name('rest.destroy');
