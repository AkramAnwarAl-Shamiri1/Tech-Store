<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Photo;

class PhotoFactory extends Factory
{
    protected $model = Photo::class;

    public function definition()
    {
        return [
            'title' => $this->faker->words(2, true),
            'image_path' => $this->faker->imageUrl(640,480),
            'link' => $this->faker->url(),
            'status' => $this->faker->randomElement(['active','inactive']),
        ];
    }
}
