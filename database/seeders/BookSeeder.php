<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::create([
            'title' => 'Book 1',
            'isbn' => '111-1-11-111111-1',
            'pages' => 100,
        ]);

        Book::create([
            'title' => 'Book 2',
            'isbn' => '222-2-22-222222-2',
            'pages' => 200,
        ]);

        Book::create([
            'title' => 'Book 3',
            'isbn' => '333-3-33-333333-3',
            'pages' => 300,
        ]);
    }
}
