<?php

namespace App\Http\Resources\Production;

use App\Domain\Production\Enums\RequestStatusEnum;
use App\Domain\Production\Enums\RequestTypeEnum;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MaterialRequestListResource extends JsonResource
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
            'title' => $this->getTitle(),
            'requester_name' => $this->getRequesterName(),
            'requested_at' => $this->requested_at,
            'status' => RequestStatusEnum::from($this->status?->code)->label(),
            'type' => RequestTypeEnum::from($this->type?->code)->label(),
            'items' => MaterialRequestItemListResource::collection($this->items)
        ];
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
        if (!count($this->items)) {
            return '';
        }

        $item = $this->items->first();
        $locationName = $item->machine->name ?? $item->storageLocation->name;

        return $item->material->part_number .' for '. $locationName;
    }
}
