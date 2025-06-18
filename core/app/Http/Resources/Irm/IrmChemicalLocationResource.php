<?php

namespace App\Http\Resources\Irm;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IrmChemicalLocationResource extends JsonResource
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
                'irm_chemical' => $this->whenLoaded('irmChemical', $this->irmChemical),
                'storage_location' => $this->whenLoaded('storageLocation', $this->storageLocation),
            ],
            'computed' => [
                'irm_chemical_part_number' => $this->whenLoaded('irmChemical', $this->irmChemical?->material?->part_number),
                'irm_chemical_description' => $this->whenLoaded('irmChemical', $this->irmChemical?->material?->description),
                'irm_chemical_container_type_name' => $this->whenLoaded('irmChemical', $this->irmChemical?->material?->materialContainerType?->name),
                'storage_location_name' => $this->whenLoaded('storageLocation', $this->storageLocation?->name),
            ]
        ];
    }
}
