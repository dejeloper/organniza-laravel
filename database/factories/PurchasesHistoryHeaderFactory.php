<?php

namespace Database\Factories;

use App\Models\PurchasesHistoryHeader;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchasesHistoryHeaderFactory extends Factory
{
    protected $model = PurchasesHistoryHeader::class;

    public function definition(): array
    {
        return [
            'year' => $this->faker->year,
            'month' => $this->faker->month,
            'amount_purchase' => $this->faker->randomFloat(2, 100, 5000),
            'total_purchase' => $this->faker->randomFloat(2, 500, 20000),
            'enabled' => $this->faker->boolean,
        ];
    }
}
