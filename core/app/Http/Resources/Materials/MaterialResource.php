<?php

namespace App\Http\Resources\Materials;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MaterialResource extends JsonResource
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
                'material_container_type' => $this->whenLoaded('materialContainerType', $this->materialContainerType),
                'material_type' => $this->whenLoaded('materialType', $this->materialType),
            ],
            'computed' => [
                'material_container_type_name' => $this->whenLoaded('materialContainerType', $this->materialContainerType?->name),
                'material_type_code' => $this->whenLoaded('materialType', $this->materialType?->code),
                'material_type_name' => $this->whenLoaded('materialType', $this->materialType?->name),
            ]
        ];
    }
}
