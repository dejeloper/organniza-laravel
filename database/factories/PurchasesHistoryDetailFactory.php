<?php

namespace Database\Factories;

use App\Models\PurchasesHistoryDetail;
use App\Models\PurchasesHistoryHeader;
use App\Models\Product;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchasesHistoryDetailFactory extends Factory
{
    protected $model = PurchasesHistoryDetail::class;

    public function definition(): array
    {
        return [
            'purchases_history_header_id' => PurchasesHistoryHeader::factory(),
            'product_id' => Product::factory(),
            'amount_product' => $this->faker->numberBetween(1, 50),
            'unit_product_id' => Unit::factory(),
            'sub_total_product' => $this->faker->randomFloat(2, 10, 1000),
            'enabled' => $this->faker->boolean(),
        ];
    }
}
