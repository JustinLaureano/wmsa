<?php

namespace Database\Factories;

use App\Models\ConversationGroup;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ConversationGroupParticipant>
 */
class ConversationGroupParticipantFactory extends Factory
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
            'conversation_group_uuid' => ConversationGroup::factory(),
            'user_uuid' => User::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
