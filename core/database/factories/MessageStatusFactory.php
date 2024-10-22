<?php

namespace Database\Factories;

use App\Models\Message;
use App\Models\Teammate;
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
        $messageUuid = Message::query()->inRandomOrder()->first()->uuid;
        $participantId = Teammate::query()->inRandomOrder()->first()->clock_number;
        $participantType = 'teammate';

        return [
            'uuid' => Str::uuid(),
            'message_uuid' => $messageUuid,
            'participant_id' => $participantId,
            'participant_type' => $participantType,
            'is_read' => Lottery::odds(2, 3)->choose() ? true: false,
            'read_at' => now(),
        ];
    }
}
