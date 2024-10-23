<?php

namespace App\Domain\Messaging\DataTransferObjects;

use Spatie\LaravelData\Data;

class GetConversationsData extends Data
{
    public function __construct(
        public readonly string $participant_id,
        public readonly string $participant_type,
    ) {

    }
}
