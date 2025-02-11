<?php

namespace App\Http\Resources\Production;

use App\Domain\Materials\Enums\UnitOfMeasureEnum;
use App\Domain\Production\Enums\RequestItemStatusEnum;
use Carbon\Carbon;
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
            'material_part_number' => $this->material->part_number,
            'material_description' => $this->material->description,
            'quantity_requested' => $this->quantity_requested,
            'quantity_delivered' => $this->quantity_delivered,
            'unit_of_measure' => UnitOfMeasureEnum::from($this->unit_of_measure)->label(),
            'machine_name' => $this->machine?->name,
            'storage_location_name' => $this->storage_location?->name,
            'status' => RequestItemStatusEnum::from($this->status?->code)->label(),
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

    /**
     * Return the title of the request.
     */
    protected function getTitle() : string
    {
        // TODO: get title from items
        return 'Material Request Title for List';
    }
}
