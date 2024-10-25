<?php

namespace App\Http\Resources\Messaging;

use App\Domain\Messaging\DataTransferObjects\ParticipantConversationsData;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ConversationCollection extends ResourceCollection
{
    protected ParticipantConversationsData $participantData;

    public function __construct(
        $resource,
        ParticipantConversationsData $participantData
    )
    {
        $this->participantData = $participantData;

        parent::__construct($resource);
    }

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection,
            'unread_comments' => 5
        ];
    }
}
