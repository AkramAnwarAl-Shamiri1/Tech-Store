<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // تعطيل قيود المفتاح الخارجي مؤقتًا
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // مسح كل البيانات القديمة
        DB::table('categories')->truncate();
        
        // إعادة تفعيل قيود المفتاح الخارجي
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // إنشاء الفئات باستخدام Factory
        Category::factory()->count(5)->create();
    }
}
