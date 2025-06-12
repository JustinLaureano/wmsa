<?php

namespace App\Domain\Materials\DataTransferObjects\Requests;

use Spatie\LaravelData\Data;

class UpdateContainerQuantityPayload extends Data
{
    public function __construct(
        public readonly string $material_container_uuid,
        public readonly int $quantity,
        public readonly string $user_uuid,
        public readonly string $updated_at,
    ) {

    }

    public static function rules(): array
    {
        return [
            'material_container_uuid' => [
                'required',
                'exists:material_containers,uuid'
            ],
            'quantity' => [
                'required',
                'integer',
                'min:0'
            ],
            'user_uuid' => [
                'required',
                'exists:users,uuid'
            ],
            'updated_at' => [
                'required',
                'date'
            ],
        ];
    }
}
