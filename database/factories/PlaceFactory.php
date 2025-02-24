<?php

namespace Database\Factories;

use App\Models\Place;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Place>
 */
class PlaceFactory extends Factory
{
    protected $model = Place::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
            'short_name' => $this->faker->word,
            'bg_color' => $this->faker->hexColor,
            'text_color' => $this->faker->hexColor,
            'enabled' => $this->faker->boolean,
        ];
    }
}
