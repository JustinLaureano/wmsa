<?php

namespace App\Http\Resources\Materials;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Repositories\BuildingRepository;

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

        $buildings = (new BuildingRepository())->getBuildingIds();

        $onHand = [];

        foreach ($buildings as $buildingId) {
            $onHand['building_'.$buildingId.'_on_hand'] = 0;
        }

        foreach ($this->containers as $container) {
            $onHand['building_'.$container->location->area->building_id.'_on_hand'] += $container->quantity;
        }

        $computed = array_merge($onHand, [
            'material_uuid' => $this->uuid,
        ]);

        return [
            'uuid' => $this->uuid,
            'attributes' => $attributes,
            'relations' => [
                'containers' => $this->whenLoaded('containers', $this->containers),
            ],
            'computed' => $computed
        ];
    }
}
