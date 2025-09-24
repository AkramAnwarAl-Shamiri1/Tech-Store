<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\ProductTag;

class ProductTagSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('product_tags')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        ProductTag::factory()->count(5)->create(); // عدد روابط المنتجات مع Tags
    }
}
