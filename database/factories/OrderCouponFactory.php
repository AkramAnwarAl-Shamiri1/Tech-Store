<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\OrderCoupon as Pivot;

class OrderCouponFactory extends Factory
{
    protected $model = Pivot::class;

    public function definition()
    {
        return [
        
    'order_id' => \App\Models\Order::inRandomOrder()->first()->id,
    'coupon_id' => \App\Models\Coupon::inRandomOrder()->first()->id,
    'created_at' => now(),
    'updated_at' => now(),
];

       
    }
}
