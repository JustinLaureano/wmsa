<?php

namespace Database\Factories;

use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Lottery;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MessageStatus>
 */
class MessageStatusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => Str::uuid(),
            'message_uuid' => Message::factory(),
            'user_uuid' => User::factory(),
            'is_read' => Lottery::odds(2, 3)->choose(),
            'read_at' => fn (array $attributes) => $attributes['is_read'] ? now() : null
        ];
    }
}
