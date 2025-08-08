<?php

namespace Database\Factories;

use App\Models\Publisher;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Publisher>
 */
class PublisherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'publisher_id' => $this->faker->uuid,
            'publisher_name' => $this->faker->unique()->company,
            'publisher_deskription' => $this->faker->sentence,
            // Soft deletes and timestamps are handled by the migration
        ];
    }
}
