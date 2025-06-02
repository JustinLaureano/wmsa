<?php

namespace App\Domain\Messaging\DataTransferObjects;

use Spatie\LaravelData\Data;

class MessageData extends Data
{
    public function __construct(
        public readonly string $uuid,
        public readonly string $conversation_uuid,
        public readonly string $user_uuid,
        public readonly string $content,
    ) {}
}
