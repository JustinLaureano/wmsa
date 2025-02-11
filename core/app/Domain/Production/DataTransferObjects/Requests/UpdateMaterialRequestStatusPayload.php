<?php

namespace App\Domain\Production\DataTransferObjects\Requests;

use Spatie\LaravelData\Data;

class UpdateMaterialRequestStatusPayload extends Data
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
