<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\RoleUser as Pivot;

class RoleUserFactory extends Factory
{
    protected $model = Pivot::class;

    public function definition()
    {
        return [
            'user_id' => \App\Models\User::inRandomOrder()->first()->id,
            'role_id' => \App\Models\Role::inRandomOrder()->first()->id,
        ];
    }
}
