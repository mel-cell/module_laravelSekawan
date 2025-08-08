<?php

namespace Database\Factories;

use App\Models\Shelf;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shelf>
 */
class ShelfFactory extends Factory
{   
    protected $model = Shelf::class;

    public function definition()
    {
        return [
            'shelf_id' => Str::uuid(),
            'shelf_name' => fake()->unique()->word . ' Shelf',
            'shelf_position' => fake()->unique()->numerify('Rak #, Lantai #'),
        ];
    }
}
