<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Transaction;

class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    public function definition()
    {
        $order = \App\Models\Order::inRandomOrder()->first();
        return [
            'order_id' => $order->id,
            'amount' => $order->total,
            'payment_method' => $this->faker->randomElement(['card','paypal','cash']),
            'status' => $this->faker->randomElement(['success','failed','pending']),
        ];
    }
}
