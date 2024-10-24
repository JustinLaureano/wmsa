<?php

namespace App\Domain\Messaging\Actions;

use App\Domain\Messaging\DataTransferObjects\GetConversationsData;
use App\Repositories\ConversationRepository;
use Illuminate\Database\Eloquent\Collection;

class GetConversationsAction
{
    public function handle(GetConversationsData $data) : Collection
    {
        return (new ConversationRepository)
            ->getForParticipant(
                participant_id: $data->participant_id,
                participant_type: $data->participant_type
            );
    }
}
