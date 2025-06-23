<?php

namespace App\Http\Resources\Materials;

use App\Domain\Materials\Enums\UnitOfMeasureEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SafetyStockReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $attributes = $this->resource->toArray();
        unset($attributes['containers']);

        return [
            'uuid' => $this->uuid,
            'attributes' => $attributes,
            'relations' => [
                'containers' => $this->whenLoaded('containers', $this->containers),
            ],
            'computed' => [
                'material_uuid' => $this->uuid,
                'part_number' => $this->part_number,
                'building_1_safety_stock_formatted' => $this->unitFormatted($this->building_1_safety_stock, $this->building_1_uom),
                'building_1_on_hand_formatted' => $this->unitFormatted($this->building_1_on_hand, $this->building_1_uom),
                'building_1_difference' => $this->calculateDifference($this->building_1_safety_stock, $this->building_1_on_hand),
                'building_1_notes' => $this->building_1_notes,
                'building_2_safety_stock_formatted' => $this->unitFormatted($this->building_2_safety_stock, $this->building_2_uom),
                'building_2_on_hand_formatted' => $this->unitFormatted($this->building_2_on_hand, $this->building_2_uom),
                'building_2_difference' => $this->calculateDifference($this->building_2_safety_stock, $this->building_2_on_hand),
                'building_2_notes' => $this->building_2_notes,
                'building_3_safety_stock_formatted' => $this->unitFormatted($this->building_3_safety_stock, $this->building_3_uom),
                'building_3_on_hand_formatted' => $this->unitFormatted($this->building_3_on_hand, $this->building_3_uom),
                'building_3_difference' => $this->calculateDifference($this->building_3_safety_stock, $this->building_3_on_hand),
                'building_3_notes' => $this->building_3_notes,
            ]
        ];
    }

    /**
     * Format the unit of measure for the safety stock and on hand values.
     */
    private function unitFormatted(int|null $value, string $uom) : string|null
    {
        if ($value === null) {
            return null;
        }

        $uom = strtolower($uom);

        if ($value == 1) {
            $uomLabel = $uom == UnitOfMeasureEnum::CONT->value
                ? __('frontend.ropack')
                : UnitOfMeasureEnum::from($uom)->abbreviationLabel();
        }
        else {
            $uomLabel = $uom == UnitOfMeasureEnum::CONT->value
                ? __('frontend.ropacks')
                : UnitOfMeasureEnum::from($uom)->pluralAbbreviationLabel();
        }

        return number_format($value) . ' ' . $uomLabel;
    }

    /**
     * Calculate the difference between the safety stock and on hand values.
     */
    private function calculateDifference(int|null $safetyStock, int $onHand) : int|null
    {
        if ($safetyStock === null) {
            return null;
        }

        return $onHand - $safetyStock;
    }
}
