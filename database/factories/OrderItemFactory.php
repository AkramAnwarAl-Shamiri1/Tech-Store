<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\OrderItem;

class OrderItemFactory extends Factory
{
    protected $model = OrderItem::class;

    public function definition()
    {
        $product = \App\Models\Product::inRandomOrder()->first();
        return [
            'order_id' => \App\Models\Order::inRandomOrder()->first()->id,
            'product_id' => $product->id,
            'quantity' => $this->faker->numberBetween(1,5),
            'price' => $product->price,
        ];
    }
}
