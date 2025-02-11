<?php

namespace App\Domain\Production\DataTransferObjects\Requests;

use Spatie\LaravelData\Data;

class CreateMaterialRequestPayload extends Data
{
    /**
     * @param array<CreateMaterialRequestItemPayload> $items
     */
    public function __construct(
        public readonly array $items,
        public readonly string $material_request_type_code,
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
            'material_request_type_code' => [
                'required',
                'exists:material_request_types,code'
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
