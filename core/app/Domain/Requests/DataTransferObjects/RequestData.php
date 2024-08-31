<?php

namespace App\Domain\Requests\DataTransferObjects;

use Spatie\LaravelData\Data;

class RequestData extends Data
{
    public function __construct(
        public string $part_id,
        public string $location_id,
    ) {
    }

    public static function rules(): array
    {
        return [
            'part_id' => ['required', 'exists:parts,id'],
            'location_id' => ['required', 'exists:locations,id'],
        ];
    }
}