<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Message;

class MessageFactory extends Factory
{
    protected $model = Message::class;

    public function definition()
    {
        $users = \App\Models\User::inRandomOrder()->take(2)->get();
        return [
            'sender_id' => $users->first()->id,
            'receiver_id' => $users->last()->id,
            'subject' => $this->faker->sentence(3),
            'body' => $this->faker->paragraph(),
        ];
    }
}
