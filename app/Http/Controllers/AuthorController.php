<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function destroy(Author $author)
    {
        $author->delete();

        return back()->with('success', 'The author has been deleted.');
    }

    public function editAuthor(Author $author)
    {
        return view('authors.edit', [
            'author' => $author
        ]);
    }

    public function listAuthors()
    {
        return view('authors', [
            'authors' => Author::all()
        ]);
    }

    public function saveAuthor()
    {
        $attributes = request()->validate([
            'name' => 'required|min:1|max:255',
            'email' => 'required|min:1|max:255|email:rfc,dns'
        ]);

        try {
            $author = Author::create($attributes);

            return back()->with('success', 'Your author has been created.');
        } catch (\Exception $e) {
            return back()->with('error', 'There was an error creating the author: ' . $e->getMessage());
        }
    }
}
