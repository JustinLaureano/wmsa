<?php

namespace App\Http\Resources\Irm;

use App\Domain\Materials\Enums\UnitOfMeasureEnum;
use App\Http\Resources\Materials\MaterialResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IrmChemicalInventoryResource extends JsonResource
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
                'inventory' => $this->whenLoaded('inventory', IrmChemicalLocationResource::collection($this->inventory)),
            ],
            'computed' => [
                'part_number' => $this->whenLoaded('material', $this->material?->part_number),
                'total_quantity' => $this->whenLoaded('inventory', $this->sumTotalQuantity()),
                'unit_of_measure_label' => $this->whenLoaded('material', $this->getUnitOfMeasureLabel()),
            ]
        ];
    }

    /**
     * Sum the total quantity of the inventory.
     */
    public function sumTotalQuantity(): int
    {
        return $this->inventory->reduce(function ($carry, $item) {
            return $carry + $item->quantity;
        }, 0);
    }

    public function getUnitOfMeasureLabel(): string
    {
        if ($this->sumTotalQuantity() === 1) {
            return UnitOfMeasureEnum::from(strtolower($this->material?->base_unit_of_measure))->abbreviationLabel();
        }

        return UnitOfMeasureEnum::from(strtolower($this->material?->base_unit_of_measure))->pluralAbbreviationLabel();
    }
}
