<?php

namespace App\Http\Resources\Locations;

use App\Domain\Locations\Enums\StorageLocationTypeEnum;
use App\Http\Resources\Materials\MaterialContainerResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StorageLocationResource extends JsonResource
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
                'area' => new StorageLocationAreaResource($this->area),
                'containers' => MaterialContainerResource::collection($this->containers),
                'type' => new StorageLocationTypeResource($this->type),
            ],
            'computed' => [
                'container_count' => $this->containers->count(),
                'location_type' => StorageLocationTypeEnum::from($this->type->name)->label(),
            ]
        ];
    }
}
