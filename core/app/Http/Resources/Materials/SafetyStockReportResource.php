<?php

namespace App\Http\Resources\Materials;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Repositories\BuildingRepository;

class SafetyStockReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $attributes = $this->resource->toArray();
        unset($attributes['containers']);

        return [
            'uuid' => $this->uuid,
            'attributes' => $attributes,
            'relations' => [
                'containers' => $this->whenLoaded('containers', $this->containers),
            ],
            'computed' => [
                'material_uuid' => $this->uuid,
            ]
        ];
    }
}
