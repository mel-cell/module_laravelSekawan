<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Borrowing>
 */
class BorrowingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'borrowing_id' => Str::uuid(),
            'borrowing_user_id' => null,
            'borrowing_returned' => fake()->boolean(30), // 30% sudah dikembalikan
            'borrowing_notes' => fake()->optional()->sentence,
            'borrowing_fine' => fake()->optional()->numberBetween(0, 50000),
            'borrowing_borrowed_at' => fake()->dateTimeBetween('-1 month', 'now'),
            'returned_at' => null,
        ];
    }
}
