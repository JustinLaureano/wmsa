<?php

namespace App\Http\Resources\Production;

use App\Domain\Materials\Enums\UnitOfMeasureEnum;
use App\Domain\Production\Enums\RequestItemStatusEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MaterialRequestItemListResource extends JsonResource
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
            'description' => $this->getDescription(),
            'material_part_number' => $this->material->part_number,
            'material_description' => $this->material->description,
            'quantity_requested' => $this->quantity_requested,
            'quantity_delivered' => $this->quantity_delivered,
            'unit_of_measure' => UnitOfMeasureEnum::from($this->unit_of_measure)->label(),
            'machine_name' => $this->machine?->name,
            'storage_location_name' => $this->storage_location?->name,
            'status' => RequestItemStatusEnum::from($this->status?->code)->label(),
            'material_tote_type_name' => $this->materialToteType?->tote,
            'container_allocation' => $this->containerAllocation,
        ];
    }

    /**
     * Return the description of the request item.
     */
    protected function getDescription() : string
    {
        $locationName = $this->machine->name ?? $this->storageLocation->name;

        return $this->material->part_number .' for '. $locationName;
    }
}
