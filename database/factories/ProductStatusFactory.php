<?php

namespace Database\Factories;

use App\Models\ProductStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductStatus>
 */
class ProductStatusFactory extends Factory
{
    protected $model = ProductStatus::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'enabled' => $this->faker->boolean(),
        ];
    }
}
