<?php

namespace App\Http\Resources\Quality;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Domain\Materials\Support\Barcode\BarcodeFactory;

class ViewSortLocationInventoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'material_container_uuid' => $this->material_container_uuid,
            'material_uuid' => $this->material_uuid,
            'barcode' => $this->barcode,
            'barcode_label' => BarcodeFactory::make($this->barcode)->toArray(),
            'lot_number' => $this->lot_number,
            'quantity' => $this->quantity,
            'part_number' => $this->part_number,
            'movement_status_name' => $this->movement_status_name,
            'storage_location_building_id' => $this->storage_location_building_id,
            'storage_location_area_name' => $this->storage_location_area_name,
            'storage_location_name' => $this->storage_location_name,
        ];
    }
}
