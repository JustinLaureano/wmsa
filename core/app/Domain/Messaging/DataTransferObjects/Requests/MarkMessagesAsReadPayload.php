<?php

namespace App\Domain\Messaging\DataTransferObjects\Requests;

use Spatie\LaravelData\Data;

class MarkMessagesAsReadPayload extends Data
{
    public function __construct(
        public readonly string $conversation_uuid,
        public readonly string $user_uuid,
        public readonly string $read_at,
    )
    {

    }

    public static function rules(): array
    {
        return [
            'conversation_uuid' => [
                'required',
                'exists:conversations,uuid'
            ],
            'user_uuid' => [
                'required',
                'exists:users,uuid'
            ],
            'read_at' => [
                'required',
                'date'
            ],
        ];
    }
}
