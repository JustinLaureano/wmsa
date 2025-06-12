<?php

namespace App\Http\Resources\Locations;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StorageLocationTypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->uuid,
            'attributes' => $this->attributes->toArray(),
            'relations' => [
                //
            ],
            'computed' => [
                //
            ]
        ];
    }
}
