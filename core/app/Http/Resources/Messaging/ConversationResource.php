<?php

namespace App\Http\Resources\Messaging;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConversationResource extends JsonResource
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
                'latest_message' => $this->latestMessage,
                'participants' => $this->participants
            ],
            'computed' => [
                'unread_messages' => 5
            ],
            'meta' => [
                'timestamp' => now()
            ]
        ];
    }
}
