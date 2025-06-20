<?php

namespace App\Http\Resources\Irm;

use App\Http\Resources\Materials\MaterialResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IrmChemicalResource extends JsonResource
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
                'material' => $this->whenLoaded('material', new MaterialResource($this->material)),
                'assigned_storage_location' => $this->whenLoaded('assignedStorageLocation', $this->assignedStorageLocation),
                'drop_off_storage_location' => $this->whenLoaded('dropOffStorageLocation', $this->dropOffStorageLocation),
            ],
            'computed' => [
                'barcode_label_id' => $this->id,
                'material_part_number' => $this->whenLoaded('material', $this->material?->part_number),
                'material_description' => $this->whenLoaded('material', $this->material?->description),
                'base_unit_of_measure' => $this->whenLoaded('material', $this->material?->base_unit_of_measure),
                'material_container_type_name' => $this->whenLoaded('material', $this->material?->materialContainerType?->name),
                'assigned_storage_location_name' => $this->whenLoaded('assignedStorageLocation', $this->assignedStorageLocation?->name),
                'drop_off_storage_location_name' => $this->whenLoaded('dropOffStorageLocation', $this->dropOffStorageLocation?->name),
            ]
        ];
    }
}
