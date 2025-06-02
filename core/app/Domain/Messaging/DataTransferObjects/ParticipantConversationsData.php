<?php

namespace App\Domain\Messaging\DataTransferObjects;

use Spatie\LaravelData\Data;

class ParticipantConversationsData extends Data
{
    public function __construct(
        public readonly string $user_uuid,
    ) {

    }
}
