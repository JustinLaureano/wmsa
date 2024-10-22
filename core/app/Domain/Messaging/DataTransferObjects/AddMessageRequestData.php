<?php

namespace App\Domain\Messaging\DataTransferObjects;

use App\Domain\Messaging\Enums\SenderTypeEnum;
use Illuminate\Validation\Rule;
use Spatie\LaravelData\Data;

class AddMessageRequestData extends Data
{
    public function __construct(
        public readonly string $conversation_uuid,
        public readonly string $sender_id,
        public readonly string $sender_type,
        public readonly string $message,
    ) {

    }

    public static function rules(): array
    {
        return [
            'conversation_uuid' => [
                'required',
                'exists:conversations,uuid'
            ],
            'sender_id' => [
                'required',
                'string'
            ],
            'sender_type' => [
                'required',
                Rule::in(SenderTypeEnum::toArray())
            ],
            'message' => [
                'required',
                'string'
            ],
        ];
    }
}
