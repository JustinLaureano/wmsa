<?php

namespace App\Domain\Messaging\DataTransferObjects;

use Spatie\LaravelData\Data;

class ConversationParticipantData extends Data
{
    public function __construct(
        public readonly string $uuid,
        public readonly string $conversation_uuid,
        public readonly string $participant_id,
        public readonly string $participant_type,
    ) {

    }
}
