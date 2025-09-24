<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\File;

class FileFactory extends Factory
{
    protected $model = File::class;

    public function definition()
    {
        $types = ['App\\\\Models\\\\Product','App\\\\Models\\\\User','App\\\\Models\\\\Vendor'];
        $type = $this->faker->randomElement($types);
        $id = ($type === 'App\\\\Models\\\\Product') ? \App\Models\Product::inRandomOrder()->first()->id : \App\Models\User::inRandomOrder()->first()->id;

        return [
            'fileable_type' => $type,
            'fileable_id' => $id,
            'type' => $this->faker->randomElement(['image','video','document']),
            'file_path' => $this->faker->imageUrl(640,480),
            'title' => $this->faker->sentence(3),
        ];
    }
}
