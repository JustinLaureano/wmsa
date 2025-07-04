<?php

namespace Database\Factories;

use App\Models\Conversation;
use App\Models\ConversationGroup;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GroupConversation>
 */
class GroupConversationFactory extends Factory
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
            'conversation_uuid' => Conversation::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
