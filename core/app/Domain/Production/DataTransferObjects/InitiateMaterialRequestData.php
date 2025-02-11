<?php

namespace App\Domain\Production\DataTransferObjects;

use Spatie\LaravelData\Data;

/**
 * TODO: rename and restructure all of these into payload classes and directories
 * TODO: along with action data classes and normal data classes
 */
class InitiateMaterialRequestData extends Data
{
    /**
     * @param array<InitiateMaterialRequestActionData> $items
     */
    public function __construct(
        public readonly array $items,
        public readonly string $requester_user_uuid,
        public readonly string $requested_at,
    )
    {

    }

    public static function rules(): array
    {
        return [
            'items' => [
                'required',
                'array',
                'min:1'
            ],
            'requester_user_uuid' => [
                'required',
                'exists:users,uuid'
            ],
            'requested_at' => [
                'required',
                'date'
            ],
        ];
    }
}
