<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ChecklistDetail;
use App\Models\ChecklistHeader;
use App\Models\Product;
use App\Models\Unit;

class ChecklistDetailFactory extends Factory
{
    protected $model = ChecklistDetail::class;

    public function definition(): array
    {
        return [
            'checklist_header_id' => ChecklistHeader::factory(),
            'product_id' => Product::factory(),
            'pantry_amount_product' => $this->faker->randomFloat(2, 1, 100),
            'pantry_unit_product' => Unit::factory(),
            'required_amount_product' => $this->faker->randomFloat(2, 1, 50),
            'required_unit_product' => Unit::factory(),
            'enabled' => $this->faker->boolean,
        ];
    }
}
