<?php

namespace App\Http\Resources\Locations;

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

            ]
        ];
    }
}
