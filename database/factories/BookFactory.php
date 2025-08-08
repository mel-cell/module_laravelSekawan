<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */

namespace Database\Factories;

use App\Models\Borrowing;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
         return [
            'book_id' => Str::uuid(),
            'book_name' => fake()->sentence(3),
            'book_isbn' => fake()->unique()->numerify('978-##########'),
            'book_stock' => fake()->numberBetween(1, 20),
            'book_description' => fake()->paragraphs(3, true),
            'book_img' => fake()->image('public/storage/books', 400, 600, 'books', null, false),

            // Relasi (akan otomatis isi jika pakai factory dengan create())
            'book_category_id' => null,
            'book_publisher_id' => null,
            'book_author_id' => null,
            'book_shelf_id' => null,
        ];
    }
}
