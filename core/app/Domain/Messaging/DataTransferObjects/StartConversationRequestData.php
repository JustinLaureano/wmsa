<?php

namespace App\Domain\Messaging\DataTransferObjects;

use App\Domain\Messaging\Enums\SenderTypeEnum;
use Illuminate\Validation\Rule;
use Spatie\LaravelData\Data;

class StartConversationRequestData extends Data
{
    public function __construct(
        public readonly string $sender_id,
        public readonly string $sender_type,
        public readonly string $participants,
        public readonly string $message,
    ) {

    }

    public static function rules(): array
    {
        return [
            'sender_id' => [
                'required',
                'string'
            ],
            'sender_type' => [
                'required',
                Rule::in(SenderTypeEnum::toArray())
            ],
            'participants' => [
                'required',
            ],
            'message' => [
                'required',
                'string'
            ],
        ];
    }
}
