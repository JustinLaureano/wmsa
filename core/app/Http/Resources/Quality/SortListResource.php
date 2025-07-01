<?php

namespace App\Http\Resources\Quality;

use App\Http\Resources\Materials\MaterialResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SortListResource extends JsonResource
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
            'attributes' => $this->resource->getAttributes(),
            'relations' => [
                'customer' => $this->whenLoaded('customer', $this->customer),
                'material' => $this->whenLoaded('material', new MaterialResource($this->material)),
            ],
            'computed' => [
                'customer_name' => $this->whenLoaded('customer', $this->customer?->name),
                'material_part_number' => $this->whenLoaded('material', $this->material?->part_number),
                'material_description' => $this->whenLoaded('material', $this->material?->description),
            ]
        ];
    }
}
