<?php

namespace App\Http\Resources\Messaging;

use App\Domain\Messaging\DataTransferObjects\ParticipantConversationsData;
use App\Domain\Messaging\Enums\ParticipantTypeEnum;
use App\Models\Teammate;
use App\Models\User;
use App\Repositories\MessageRepository;
use App\Repositories\TeammateRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ConversationCollection extends ResourceCollection
{
    protected ParticipantConversationsData $participantData;

    protected Teammate $teammate;

    protected User $user;

    public function __construct(
        $resource,
        ParticipantConversationsData $participantData
    )
    {
        $this->participantData = $participantData;
        $this->setParticipantAccounts();

        parent::__construct($resource);
    }

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $this->collection->map(function(ConversationResource $conversation) {
            $conversation->setRequestParticipant(
                participantData: $this->participantData,
                teammate: $this->teammate,
                user: $this->user
            );
        });


        return [
            'data' => $this->collection->toArray(),
            'computed' => [
                'unread_comments' => $this->getUnreadComments()
            ],
            'meta' => [
                'timestamp' => now()
            ],
        ];
    }

    /**
     * Use the participant data to determine the teammate
     * and user accounts associated with the participant.
     */
    protected function setParticipantAccounts() : void
    {
        $teammateRepository = new TeammateRepository;
        $userRepository = new UserRepository;

        if ( $this->participantIsTeammate() )
        {
            $this->teammate = $teammateRepository
                ->findByClockNumber($this->participantData->participant_id);

            $this->user = $this->teammate->user_guid
                ? $userRepository->findBy('guid', $this->teammate->user_guid)
                : null;
        }

        else if ( $this->participantIsUser() )
        {
            $this->user = $userRepository
                ->findBy('guid', $this->participantData->participant_id)
                ->load('teammate');

            $this->teammate = $teammateRepository->findByUserGuid($this->user->guid);
        }
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

        if (
            $this->participantIsTeammate() &&
            $this->user
        ) {
            $secondaryId = $this->user->guid;
            $secondaryType = ParticipantTypeEnum::USER->value;
        }

        else if (
            $this->participantIsUser() &&
            $this->teammate
        ) {
            $secondaryId = $this->teammate->clock_number;
            $secondaryType = ParticipantTypeEnum::TEAMMATE->value;
        }

        return (new MessageRepository)
            ->getUnreadMessagesCount(
                primaryId: $primaryId,
                primaryType: $primaryType,
                secondaryId: $secondaryId,
                secondaryType: $secondaryType
            );
    }

    protected function participantIsTeammate() : bool
    {
        return $this->participantData->participant_type === ParticipantTypeEnum::TEAMMATE->value;
    }

    protected function participantIsUser() : bool
    {
        return $this->participantData->participant_type === ParticipantTypeEnum::USER->value;
    }
}
