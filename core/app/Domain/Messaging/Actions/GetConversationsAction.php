<?php

namespace App\Domain\Messaging\Actions;

use App\Domain\Messaging\DataTransferObjects\GetConversationsData;
use App\Domain\Messaging\Enums\ParticipantTypeEnum;
use App\Repositories\ConversationRepository;
use App\Repositories\TeammateRepository;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Collection;

class GetConversationsAction
{
    public function handle(GetConversationsData $data) : Collection
    {
        $conversationRepository = new ConversationRepository;

        $primaryConversations = $conversationRepository
            ->getForParticipant(
                participant_id: $data->participant_id,
                participant_type: $data->participant_type
            );

        $secondaryConversations = new Collection();

        if ($data->participant_type === ParticipantTypeEnum::TEAMMATE->value) {
            $teammate = (new TeammateRepository)->findByClockNumber($data->participant_id)->load('user');

            if ($teammate->user) {
                $id = $teammate->user->guid;
                $type = ParticipantTypeEnum::USER->value;

                $secondaryConversations = $conversationRepository
                    ->getForParticipant(
                        participant_id: $id,
                        participant_type: $type
                    );
            }
        }

        else if ($data->participant_type === ParticipantTypeEnum::USER->value) {
            $user = (new UserRepository)->findBy('guid', $data->participant_id)->load('teammate');

            if ($user->teammate) {
                $id = $user->teammate->clock_number;
                $type = ParticipantTypeEnum::TEAMMATE->value;

                $secondaryConversations = $conversationRepository
                    ->getForParticipant(
                        participant_id: $id,
                        participant_type: $type
                    );
            }
        }

        $conversations = $primaryConversations
            ->merge($secondaryConversations)
            ->sortBy('latestMessage.created_at', descending: true);

        return $conversations;
    }
}
