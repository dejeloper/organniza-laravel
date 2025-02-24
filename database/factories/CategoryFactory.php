<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'icon' => 'icon.png',
            'bg_color' => '#FFFFFF',
            'text_color' => '#000000',
            'enabled' => true,
        ];
    }
}
