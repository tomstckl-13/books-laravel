<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RestController extends Controller
{
    public function destroy(Book $book)
    {
        $book->delete();
        return response()->noContent();
    }
}
