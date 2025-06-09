<?php

namespace App\Domain\Messaging\Actions;

use App\Domain\Messaging\DataTransferObjects\ConversationData;
use App\Domain\Messaging\DataTransferObjects\MessageData;
use App\Domain\Messaging\DataTransferObjects\Requests\StartConversationPayload;
use App\Domain\Messaging\Events\MessageSent;
use App\Models\Conversation;
use App\Models\ConversationParticipant;
use App\Models\MessageStatus;
use App\Repositories\ConversationRepository;
use App\Repositories\MessageRepository;
use Illuminate\Support\Str;

class StartConversationAction
{
    public function handle(StartConversationPayload $data): Conversation
    {
        // Create conversation
        $conversation = (new ConversationRepository)
            ->store(new ConversationData(
                uuid: Str::uuid(),
                group_conversation: $data->group_conversation
            ));

        // Add participants
        $participantUuids = array_unique(array_merge(
            [$data->user_uuid],
            $data->participants
        ));

        foreach ($participantUuids as $userUuid) {
            ConversationParticipant::create([
                'uuid' => Str::uuid(),
                'conversation_uuid' => $conversation->uuid,
                'user_uuid' => $userUuid,
            ]);
        }

        // Create initial message
        $message = (new MessageRepository)
            ->store(new MessageData(
                uuid: Str::uuid(),
                conversation_uuid: $conversation->uuid,
                user_uuid: $data->user_uuid,
                content: $data->content
            ));

        // Create message status for all participants except sender
        foreach ($participantUuids as $userUuid) {
            if ($userUuid !== $data->user_uuid) {
                MessageStatus::create([
                    'uuid' => Str::uuid(),
                    'message_uuid' => $message->uuid,
                    'user_uuid' => $userUuid,
                    'is_read' => false,
                    'read_at' => null,
                ]);
            }
        }

        // Dispatch event
        MessageSent::dispatch($message);

        return $conversation->load(['latestMessage.user.teammate', 'participants.teammate']);
    }
}