<?php

namespace App\Http\Resources\Materials;

use App\Domain\Materials\Enums\MovementStatusEnum;
use App\Domain\Materials\Support\Barcode\BarcodeFactory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MaterialContainerInventoryResource extends JsonResource
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
            'attributes' => [
                'barcode' => $this->barcode,
                'lot_number' => $this->lot_number,
                'quantity' => $this->quantity,
                'expiration_date' => $this->expiration_date,
                'movement_status_code' => $this->movement_status_code,
            ],
            'relations' => [
                'location' => $this->location,
                'containerType' =>$this->containerType,
                'materialToteType' => $this->materialToteType,
            ],
            'computed' => [
                'barcode_label' => BarcodeFactory::make($this->barcode)->toArray(),
                'movement_status' => MovementStatusEnum::from($this->movement_status_code)->label(),
                'expires_at' => $this->getExpiresAt(),
                'storage_location_uuid' => $this->location->uuid,
                'storage_location_name' => $this->location->name,
                'storage_location_barcode' => $this->location->barcode,
                'container_type' => $this->containerType ? $this->containerType : null,
                'container_type_name' => $this->containerType ? $this->containerType->name : null,
                'tote_type_name' => $this->materialToteType ? $this->materialToteType->tote : null,
                'tote_type_description' => $this->materialToteType ? $this->materialToteType->description : null,
            ]
        ];
    }

    /**
     * Return a formatted date string of the date the message was sent.
     */
    protected function getExpiresAt() : string
    {
        return (new Carbon( $this->expiration_date ))->format('n/j/Y');
    }
}
