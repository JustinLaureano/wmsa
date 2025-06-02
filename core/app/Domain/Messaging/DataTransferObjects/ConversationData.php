<?php

namespace App\Domain\Messaging\DataTransferObjects;

use Spatie\LaravelData\Data;

class ConversationData extends Data
{
    public function __construct(
        public readonly string $uuid,
        public readonly bool $group_conversation,
    ) {}
}
