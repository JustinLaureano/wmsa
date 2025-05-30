<?php

namespace App\Http\Resources\Production;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MaterialInventoryResource extends JsonResource
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
            'attributes' => [
                'material_number' => $this->material_number,
                'part_number' => $this->part_number,
                'description' => $this->description,
                'base_unit_of_measure' => $this->base_unit_of_measure,
                'base_quantity' => $this->base_quantity,
            ],
            'relations' => [
                'containers' => MaterialContainerInventoryResource::collection($this->containers),
            ],
            'computed' => [
                'material_uuid' => $this->uuid,
                'total_quantity' => $this->containers->sum('quantity'),
                'container_count' => $this->containers->count(),
                'title' => $this->getTitle(),
            ]
        ];
    }

    protected function getTitle() : string
    {
        return $this->part_number . ' (' . $this->material_number . ') ' . $this->description;
    }
}
