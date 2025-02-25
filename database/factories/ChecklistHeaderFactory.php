<?php

namespace Database\Factories;

use App\Models\ChecklistHeader;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ChecklistHeader>
 */
class ChecklistHeaderFactory extends Factory
{
    protected $model = ChecklistHeader::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'year' => fake()->numberBetween(1950, date('Y')),
            'month' => fake()->numberBetween(1, 12),
            'enabled' => fake()->boolean(),
        ];
    }
}
