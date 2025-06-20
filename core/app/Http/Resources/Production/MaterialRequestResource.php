<?php

namespace App\Http\Resources\Production;

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
                'status' => $this->status,
                'requester' => $this->requester,
                'items' => $this->items,
            ],
            'computed' => [
                'title' => $this->getTitle(),
                'requester_name' => $this->getRequesterName(),
                'requested_at' => $this->getRequestedAtDate(),
                'status' => RequestStatusEnum::from($this->status?->code)->label(),
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

    /**
     * Return the title of the request.
     */
    protected function getTitle() : string
    {
        // TODO: get title from items
        return 'Material Request Title';
    }
}
