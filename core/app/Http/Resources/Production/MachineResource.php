<?php

namespace App\Http\Resources\Production;

use App\Http\Resources\Locations\BuildingResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MachineResource extends JsonResource
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
                'building' => new BuildingResource($this->building),
                'machine_type' => $this->type,
            ],
            'computed' => [
                'barcode_label' => $this->barcode,
                'building_name' => $this->building?->name,
                'disabled' => $this->disabled,
                'machine_name' => $this->name,
                'machine_type_code' => $this->type?->code,
                'machine_type_name' => $this->type?->name,
                'restrict_request_allocations' => $this->restrict_request_allocations,
            ]
        ];
    }
}
