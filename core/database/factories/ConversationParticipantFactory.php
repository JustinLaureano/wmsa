<?php

namespace Database\Factories;

use App\Models\Conversation;
use App\Models\Teammate;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ConversationParticipant>
 */
class ConversationParticipantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $conversationUuid = Conversation::query()->inRandomOrder()->first()->uuid;
        $participantId = Teammate::query()->inRandomOrder()->first()->clock_number;
        $participantType = 'teammate';

        return [
            'uuid' => Str::uuid(),
            'conversation_uuid' => $conversationUuid,
            'participant_id' => $participantId,
            'participant_type' => $participantType,
        ];
    }
}
