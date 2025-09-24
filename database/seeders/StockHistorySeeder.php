<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StockHistory;

class StockHistorySeeder extends Seeder
{
    public function run()
    {
        StockHistory::factory()->count(5)->create();
    }
}
