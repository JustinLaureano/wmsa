<?php

namespace App\Http\Resources\Messaging;

use App\Models\User;
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
            'attributes' => [
                'uuid' => $this->uuid,
                'content' => $this->content,
                'conversation_uuid' => $this->conversation_uuid,
                'user_uuid' => $this->user_uuid,
            ],
            'relations' => [
                'status' => $this->status,
                'sender' => $this->whenLoaded('user'),
            ],
            'computed' => [
                'sender_uuid' => $this->user_uuid,
                'sender_name' => $this->getSenderName(),
                'sent_at_date' => $this->getSentAtDate(),
                'filtered_content' => $this->getFilteredContent(),
                'user_has_read' => $this->userHasRead($request->user()),
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

    /**
     * Get the is read for the message.
     */
    protected function userHasRead(User $user): bool
    {
        if (!$user) {
            return false;
        }

        if ($this->user_uuid === $user->uuid) {
            return true;
        }

        $status = $this->status->filter(function ($status) use ($user) {
                return $status->user_uuid === $user->uuid;
            })->first();

        return $status
            ? (bool) $status->is_read
            : false;
    }
}