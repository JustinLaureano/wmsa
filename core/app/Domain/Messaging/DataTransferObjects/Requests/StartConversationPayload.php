<?php

namespace App\Domain\Messaging\DataTransferObjects\Requests;

use App\Rules\ValidUserUuids;
use Spatie\LaravelData\Data;

class StartConversationPayload extends Data
{
    public function __construct(
        public readonly string $user_uuid,
        public readonly array $participants,
        public readonly string $content,
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
                'array',
                new ValidUserUuids,
            ],
            'content' => [
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
