<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ShippingMethod;

class ShippingMethodFactory extends Factory
{
    protected $model = ShippingMethod::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company() . ' Shipping',
            'cost' => $this->faker->randomFloat(2, 0, 100),
        ];
    }
}
