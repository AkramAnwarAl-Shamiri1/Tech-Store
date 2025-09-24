<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrderCoupon;

class OrderCouponSeeder extends Seeder
{
    public function run()
    {
        OrderCoupon::factory()->count(5)->create();
    }
}
