<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RoleUser;

class RoleUserSeeder extends Seeder
{
    public function run()
    {
        RoleUser::factory()->count(5)->create();
    }
}
