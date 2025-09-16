<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Shelf;
use App\Models\Publisher;
use App\Models\Category;
use App\Models\Author;
use App\Models\Book;
use App\Models\Borrowing;
use App\Models\BorrowingDetail;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    
public function run()
{   
    fake()->unique(true);
    
    // 1. Hanya create() tanpa array parameter
    \App\Models\Shelf::factory(5)->create();
    \App\Models\Publisher::factory(10)->create();
    \App\Models\Category::factory(5)->create();
    \App\Models\Author::factory(15)->create();
    \App\Models\User::factory(10)->create();

    // 2. Book: pastikan relasi tersedia
    $books = \App\Models\Book::factory(30)->create([
        'book_category_id' => \App\Models\Category::inRandomOrder()->first()->category_id ?? null,
        'book_publisher_id' => \App\Models\Publisher::inRandomOrder()->first()->publisher_id ?? null,
        'book_author_id' => \App\Models\Author::inRandomOrder()->first()->author_id ?? null,
        'book_shelf_id' => \App\Models\Shelf::inRandomOrder()->first()->shelf_id ?? null,
    ]);

    // 3. Borrowing
    \App\Models\Borrowing::factory(20)->create([
        'borrowing_user_id' => \App\Models\User::inRandomOrder()->first()->id ?? null,
    ])->each(function ($borrowing) {
        \App\Models\BorrowingDetail::factory(2)->create([
            'detail_borrowing_id' => $borrowing->borrowing_id,
            'detail_book_id' => \App\Models\Book::inRandomOrder()->first()->book_id ?? null,
        ]);
    });
}   
}
