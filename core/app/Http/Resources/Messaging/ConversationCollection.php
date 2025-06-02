<?php

namespace App\Http\Resources\Messaging;

use App\Domain\Messaging\DataTransferObjects\ParticipantConversationsData;
use App\Repositories\MessageRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ConversationCollection extends ResourceCollection
{
    protected ParticipantConversationsData $participantData;

    public function __construct($resource, ParticipantConversationsData $participantData)
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
            'data' => $this->collection->map(function (ConversationResource $conversation) use ($request) {
                $conversation->setParticipantData($this->participantData);

                return $conversation->toArray($request);
            })->all(),
            'computed' => [
                'unread_messages' => $this->getUnreadMessages(),
            ],
            'meta' => [
                'timestamp' => now(),
            ],
        ];
    }

    /**
     * Get the unread messages count for the participant.
     */
    protected function getUnreadMessages(): int
    {
        return (new MessageRepository)
            ->getUnreadMessagesCount(
                userUuid: $this->participantData->user_uuid
            );
    }
    }    }

    protected function participantIsUser() : bool
    {
        return $this->participantData->participant_type === ParticipantTypeEnum::USER->value;
    }
}
}
    protected function participantIsUser() : bool
    {
        return $this->participantData->participant_type === ParticipantTypeEnum::USER->value;
    }
}
