<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\StockHistory;

class StockHistoryFactory extends Factory
{
    protected $model = StockHistory::class;

    public function definition()
    {
        return [
            'product_id' => \App\Models\Product::inRandomOrder()->first()->id,
            'change' => $this->faker->numberBetween(-10,50),
            'reason' => $this->faker->word(),
        ];
    }
}
