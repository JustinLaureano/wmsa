<?php

namespace App\Http\Resources\Production;

use App\Domain\Materials\Enums\UnitOfMeasureEnum;
use App\Domain\Production\Enums\RequestStatusEnum;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MaterialRequestResource extends JsonResource
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
                'material_part_number' => $this->material->part_number,
                'material_description' => $this->material->description,
                'machine_name' => $this->machine?->name,
                'storage_location_name' => $this->storageLocation?->name,
                'requester_name' => $this->getRequesterName(),
                'requested_at' => $this->getRequestedAtDate(),
                'status' => RequestStatusEnum::from($this->status?->code)->label(),
                'quantity' => $this->quantity,
                'unit_of_measure' => UnitOfMeasureEnum::from($this->unit_of_measure)->label(),
            ]
        ];
    }

    /**
     * Return a formatted date string of the date the message was sent.
     */
    protected function getRequestedAtDate() : string
    {
        return (new Carbon( $this->requested_at ))->format('n/j g:i A');
    }

    /**
     * Return the name of the requester.
     */
    protected function getRequesterName() : string
    {
        return $this->requester?->teammate?->first_name . ' ' . $this->requester?->teammate?->last_name;
    }
}
