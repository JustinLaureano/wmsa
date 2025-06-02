<?php

namespace App\Domain\Messaging\DataTransferObjects;

use Spatie\LaravelData\Data;

class AddMessageRequestData extends Data
{
    public function __construct(
        public readonly string $conversation_uuid,
        public readonly string $user_uuid,
        public readonly string $content,
    ) {}

    public static function rules(): array
    {
        return [
            'conversation_uuid' => [
                'required',
                'exists:conversations,uuid',
            ],
            'user_uuid' => [
                'required',
                'exists:users,uuid',
            ],
            'content' => [
                'required',
                'string',
                'max:1000',
            ],
        ];
    }
}
