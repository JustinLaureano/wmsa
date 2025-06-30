<?php

namespace App\Domain\Auth\DataTransferObjects\Requests;

use Spatie\LaravelData\Data;

class SetSessionBuildingPayload extends Data
{
    public function __construct(
        public readonly int $building_id,
    )
    {

    }

    public static function rules(): array
    {
        return [
            'building_id' => [
                'required',
                'exists:buildings,id'
            ],
        ];
    }
}
