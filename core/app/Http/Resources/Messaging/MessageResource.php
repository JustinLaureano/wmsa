<?php

namespace App\Http\Resources\Messaging;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
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
                'sender' => $this->sender
            ],
            'computed' => [
                'filtered_content' => $this->getFilteredContent(),
            ]
        ];
    }

    /**
     * Get the title text for the conversation list option.
     */
    protected function getFilteredContent() : string
    {
        return $this->content;
    }
}
