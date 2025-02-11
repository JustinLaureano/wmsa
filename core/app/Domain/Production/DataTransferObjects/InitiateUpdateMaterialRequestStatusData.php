<?php

namespace App\Domain\Production\DataTransferObjects;

use Spatie\LaravelData\Data;

class InitiateUpdateMaterialRequestStatusData extends Data
{
    public function __construct(
        public readonly string $uuid,
        public readonly string $status_code
    ) {
    }

    public static function rules(): array
    {
        return [
            'uuid' => [
                'required',
                'exists:material_requests,uuid'
            ],
            'status_code' => [
                'required',
                'string'
            ]
        ];
    }
}
