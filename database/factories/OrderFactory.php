<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Order;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {
        $user = \App\Models\User::inRandomOrder()->first();
        return [
            'user_id' => $user->id,
            'shipping_method_id' => \App\Models\ShippingMethod::inRandomOrder()->first()->id,
            'payment_method_id' => \App\Models\PaymentMethod::inRandomOrder()->first()->id,
            'total' => $this->faker->randomFloat(2, 10, 2000),
            'status' => $this->faker->randomElement(['pending','processing','completed','cancelled']),
        ];
    }
}
