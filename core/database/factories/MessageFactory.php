<?php

namespace Database\Factories;

use App\Models\Conversation;
use App\Models\Teammate;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $conversationUuid = Conversation::query()->inRandomOrder()->first()->uuid;
        $senderId = Teammate::query()->inRandomOrder()->first()->clock_number;
        $senderType = 'teammate';

        return [
            'uuid' => Str::uuid(),
            'conversation_uuid' => $conversationUuid,
            'sender_id' => $senderId,
            'sender_type' => $senderType,
            'content' => fake()->paragraph(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
