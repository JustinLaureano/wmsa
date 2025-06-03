<?php

namespace App\Http\Resources\Production;

use App\Domain\Materials\Enums\UnitOfMeasureEnum;
use App\Domain\Production\Enums\RequestStatusEnum;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MaterialRequestItemResource extends JsonResource
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
                'material' => $this->material,
                'machine' => $this->machine,
                'status' => $this->status,
                'storage_location' => $this->storageLocation,
                'requester' => $this->requester,
                'container_allocation' => $this->containerAllocation,
            ],
            'computed' => [
                'title' => $this->getTitle(),
                'material_part_number' => $this->material->part_number,
                'material_description' => $this->material->description,
                'machine_name' => $this->machine?->name,
                'storage_location_name' => $this->storageLocation?->name,
                'status' => RequestStatusEnum::from($this->status?->code)->label(),
                'quantity_requested' => $this->quantity_requested,
                'quantity_delivered' => $this->quantity_delivered,
                'unit_of_measure' => UnitOfMeasureEnum::from($this->unit_of_measure)->label(),
                'material_tote_type_name' => $this->materialToteType?->tote,
            ]
        ];
    }

    /**
     * Return the title of the request.
     */
    protected function getTitle() : string
    {
        $locationName = $this->machine ? $this->machine->name : $this->storageLocation?->name;

        return $this->material->part_number .' to '. $locationName;
    }
}
