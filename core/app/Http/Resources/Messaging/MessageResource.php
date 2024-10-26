<?php

namespace App\Http\Resources\Messaging;

use App\Domain\Messaging\Enums\ParticipantTypeEnum;
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
                'status' => $this->status,
                'sender' => $this->sender
            ],
            'computed' => [
                'sender_name' => $this->getSenderName(),
                'sent_at_date' => $this->getSentAtDate(),
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

    /**
     * Get the sender name of the message.
     */
    protected function getSenderName() : string
    {
        if (
            $this->sender_type == ParticipantTypeEnum::TEAMMATE->value ||
            $this->sender_type == ParticipantTypeEnum::USER->value
        ) {
            $firstName = $this->sender->first_name
                ? $this->sender->first_name
                : '';

            $lastName = $this->sender->last_name
                ? $this->sender->last_name
                : '';

            if ($firstName && $lastName) {
                return $lastName .', '. $firstName;
            }
            else if ($firstName) {
                return $firstName;
            }
            else if ($lastName) {
                return $lastName;
            }
            else {
                return '';
            }
        }
        else {
            return '';
        }
    }

    /**
     * Return a formatted date string of the date the message was sent.
     */
    protected function getSentAtDate() : string
    {
        return (new Carbon( $this->created_at ))->format('n/j g:i A');
    }
}
