<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    public function run()
    {
        // تعطيل قيود المفتاح الخارجي مؤقتًا
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // مسح كل البيانات القديمة
        DB::table('tags')->truncate();
        
        // إعادة تفعيل قيود المفتاح الخارجي
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // إنشاء 20 Tag باستخدام Factory
        Tag::factory()->count(5)->create();
    }
}
