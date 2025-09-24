<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // يمسح الجدول ويعيد العدادات تلقائياً
       DB::table('roles')->delete();


        // إنشاء 5 أدوار باستخدام Factory
        Role::factory()->count(5)->create();
    }
}
