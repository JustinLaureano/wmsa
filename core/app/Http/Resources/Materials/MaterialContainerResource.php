<?php

namespace App\Http\Resources\Materials;

use App\Domain\Materials\Enums\MovementStatusEnum;
use App\Domain\Materials\Support\Barcode\BarcodeFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MaterialContainerResource extends JsonResource
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
                'material' => $this->whenLoaded('material', $this->material),
                'container_type' => $this->whenLoaded('containerType', $this->containerType),
                'tote_type' => $this->whenLoaded('materialToteType', $this->materialToteType),
                'movement_status' => $this->whenLoaded('movementStatus', $this->movementStatus),
            ],
            'computed' => [
                'barcode_label' => BarcodeFactory::make($this->barcode)->toArray(),
                'container_type_name' => $this->whenLoaded(
                    'containerType',
                    $this->containerType?->name
                ),
                'container_tote_type_name' => $this->whenLoaded(
                    'materialToteType',
                    $this->materialToteType?->tote
                ),
                'movement_status' => $this->whenLoaded(
                    'movementStatus',
                    MovementStatusEnum::from($this->movement_status_code)->label()
                ),
                'part_number' => $this->whenLoaded('material', $this->material->part_number),
            ]
        ];
    }
}
