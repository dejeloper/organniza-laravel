<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Place;
use App\Models\Product;
use App\Models\ProductStatus;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'unit_id' => Unit::factory()->create()->id,
            'price' => $this->faker->randomFloat(2, 1, 1000),
            'category_id' => Category::factory()->create()->id,
            'place_id' => Place::factory()->create()->id,
            'status_id' => ProductStatus::factory()->create()->id,
            'observation' => $this->faker->sentence(),
            'image' => 'images/products/product1.jpg',
            'enabled' => $this->faker->boolean(),
        ];
    }
}
