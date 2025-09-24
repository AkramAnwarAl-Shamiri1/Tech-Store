<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\OrderStatusHistory;

class OrderStatusHistoryFactory extends Factory
{
    protected $model = OrderStatusHistory::class;

    public function definition()
    {
        return [
            'order_id' => \App\Models\Order::inRandomOrder()->first()->id,
            'status' => $this->faker->randomElement(['pending','processing','shipped','delivered','cancelled']),
            'changed_at' => now(),
        ];
    }
}
