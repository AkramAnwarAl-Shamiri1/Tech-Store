<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ProductFile;

class ProductFileFactory extends Factory
{
    protected $model = ProductFile::class;

    public function definition()
    {
        return [
            'product_id' => \App\Models\Product::inRandomOrder()->first()->id,
            'file_path' => $this->faker->filePath(),
        ];
    }
}
