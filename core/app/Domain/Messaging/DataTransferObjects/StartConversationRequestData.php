<?php

namespace App\Domain\Messaging\DataTransferObjects;

use App\Rules\ValidUserUuids;
use Spatie\LaravelData\Data;

class StartConversationRequestData extends Data
{
    public function __construct(
        public readonly string $user_uuid,
        public readonly string $participants, // JSON string of user_uuids
        public readonly string $message,
        public readonly bool $group_conversation,
    ) {}

    public static function rules(): array
    {
        return [
            'user_uuid' => [
                'required',
                'exists:users,uuid',
            ],
            'participants' => [
                'required',
                'json',
                new ValidUserUuids,
            ],
            'message' => [
                'required',
                'string',
                'max:1000',
            ],
            'group_conversation' => [
                'required',
                'boolean',
            ],
        ];
    }
}
