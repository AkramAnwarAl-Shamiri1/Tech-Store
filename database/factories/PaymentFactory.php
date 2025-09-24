<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Payment;

class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    public function definition()
    {
        $order = \App\Models\Order::inRandomOrder()->first();
        return [
            'order_id' => $order->id,
            'amount' => $order->total,
            'status' => $this->faker->randomElement(['paid','failed','pending']),
        ];
    }
}
