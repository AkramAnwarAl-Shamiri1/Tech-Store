<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrderStatusHistory;

class OrderStatusHistorySeeder extends Seeder
{
    public function run()
    {
        OrderStatusHistory::factory()->count(5)->create();
    }
}
