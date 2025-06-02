<?php

namespace App\Http\Resources\Messaging;

use Carbon\Carbon;
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
                'status' => $this->whenLoaded('status'),
                'sender' => $this->whenLoaded('user'),
            ],
            'computed' => [
                'sender_name' => $this->getSenderName(),
                'sent_at_date' => $this->getSentAtDate(),
                'filtered_content' => $this->getFilteredContent(),
            ],
        ];
    }

    /**
     * Get the filtered content for the message.
     */
    protected function getFilteredContent(): string
    {
        return $this->content;
    }

    /**
     * Get the sender name for the message.
     */
    protected function getSenderName(): string
    {
        $user = $this->user;
        $teammate = $user->teammate;
        $firstName = $teammate->first_name ?? $user->first_name ?? '';
        $lastName = $teammate->last_name ?? $user->last_name ?? '';

        if ($firstName && $lastName) {
            return "{$lastName}, {$firstName}";
        }
        elseif ($firstName) {
            return $firstName;
        }
        elseif ($lastName) {
            return $lastName;
        }

        return 'Unknown';
    }

    /**
     * Get the sent at date for the message.
     */
    protected function getSentAtDate(): string
    {
        return (new Carbon($this->created_at))->format('n/j g:i A');
    }
}