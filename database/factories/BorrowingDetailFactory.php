<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BorrowingDetail>
 */
class BorrowingDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'detail_id' => Str::uuid(),
            'detail_borrowing_id' => null,
            'detail_book_id' => null,
            'detail_quantity' => fake()->numberBetween(1, 3),
        ];
    }
}
