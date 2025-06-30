<?php

namespace App\Http\Resources\Locations;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BuildingResource extends JsonResource
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
            'attributes' => $this->resource->toArray(),
            'relations' => [
                'organization' => $this->organization,
                'type' => $this->type,
            ],
            'computed' => [
                'building_name' => $this->name,
                'organization_name' => $this->organization?->name,
                'type_name' => $this->type?->name,
            ]
        ];
    }
}
