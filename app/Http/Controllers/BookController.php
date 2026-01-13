<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class BookController extends Controller
{
    public function destroyBook(Book $book)
    {

        if (! Gate::allows('update-book', $book))
        {
            abort(403);
        }
        $book->delete();

        return back()->with('success', 'The book has been deleted.');
    }

    public function editBook(Book $book)
    {
        if (! Gate::allows('update-book', $book))
        {
            abort(403);
        }

        $authors = Author::all();
        return view('books.edit', [
            'book' => $book,
            'authors' => $authors,
        ]);
    }

    public function updateBook(Book $book)
    {

        if (! Gate::allows('update-book', $book)) {
            abort(403);
        }

        $attributes = request()->validate([
            'isbn' => 'required|min:3|max:255',
            'title' => 'required|min:1|max:255',
            'pages' => 'required|integer',
            'author_id' => 'integer|nullable'
        ]);

        $book->update($attributes);

        return back()->with('success', 'Your book has been updated.');
    }

    public function saveBook()
    {
        $attributes = request()->validate([
            'isbn' => 'required|min:3|max:255',
            'title' => 'required|min:1|max:255',
            'pages' => 'required|integer'
        ]);

        // nach validate
        // nach min:3 max:255 und so ist er sich sicher das es richtig validiert wurde
        // also kann er es speichern
        $book = Book::create($attributes);

        /**
         * dd($book);
         * zeigt voll viel informationen an über das gespeicherte buch
         * (auch das, was wir nicht eingegeben haben)
         */

        return back()->with('success', 'Your book has been created.');
    }

    public function listBooks(): View
    {
        //$books = Book::all();
        //$books = Book::with('author')->get();
        $books = auth()->user()->books;

        return view('list', [
            'books' => $books
        ]);
    }
}
