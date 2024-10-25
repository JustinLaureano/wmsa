<?php

namespace App\Http\Resources\Messaging;

use App\Domain\Messaging\DataTransferObjects\ParticipantConversationsData;
use App\Domain\Messaging\Enums\ParticipantTypeEnum;
use App\Repositories\MessageRepository;
use App\Repositories\TeammateRepository;
use App\Repositories\UserRepository;
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
            'computed' => [
                'unread_comments' => $this->getUnreadComments()
            ],
            'meta' => [
                'timestamp' => now()
            ],
        ];
    }

    /**
     * Returns the total number of unread messages for the participant
     * across all conversations. This also includes any related
     * account conversations in the total as well.
     */
    protected function getUnreadComments() : int
    {
        $primaryId = $this->participantData->participant_id;
        $primaryType = $this->participantData->participant_type;
        $secondaryId = $this->participantData->participant_type;
        $secondaryType = $this->participantData->participant_type;

        if ($this->participantData->participant_type === ParticipantTypeEnum::TEAMMATE->value) {
            $teammate = (new TeammateRepository)
                ->findByClockNumber($this->participantData->participant_id)
                ->load('user');

            if ($teammate->user) {
                $secondaryId = $teammate->user->guid;
                $secondaryType = ParticipantTypeEnum::USER->value;
            }
        }

        else if ($this->participantData->participant_type === ParticipantTypeEnum::USER->value) {
            $user = (new UserRepository)
                ->findBy('guid', $this->participantData->participant_id)
                ->load('teammate');

            if ($user->teammate) {
                $secondaryId = $user->teammate->clock_number;
                $secondaryType = ParticipantTypeEnum::TEAMMATE->value;
            }
        }

        return (new MessageRepository)
            ->getUnreadMessagesCount(
                primaryId: $primaryId,
                primaryType: $primaryType,
                secondaryId: $secondaryId,
                secondaryType: $secondaryType
            );
    }
}
