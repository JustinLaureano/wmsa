<?php

namespace App\Domain\Messaging\Actions;

use App\Domain\Messaging\DataTransferObjects\AddMessageRequestData;
use App\Domain\Messaging\DataTransferObjects\MessageData;
use App\Domain\Messaging\Events\MessageSent;
use App\Models\ConversationParticipant;
use App\Models\Message;
use App\Models\MessageStatus;
use App\Repositories\MessageRepository;
use Illuminate\Support\Str;

class AddMessageAction
{
    public function handle(AddMessageRequestData $data): Message
    {
        $message = (new MessageRepository)
            ->store(new MessageData(
                uuid: Str::uuid(),
                conversation_uuid: $data->conversation_uuid,
                user_uuid: $data->user_uuid,
                content: $data->content
            ));

        // Add message status for participants except sender
        $participants = ConversationParticipant::where('conversation_uuid', $data->conversation_uuid)
            ->where('user_uuid', '!=', $data->user_uuid)
            ->get();

        foreach ($participants as $participant) {
            MessageStatus::create([
                'uuid' => Str::uuid(),
                'message_uuid' => $message->uuid,
                'user_uuid' => $participant->user_uuid,
                'is_read' => false,
                'read_at' => null,
            ]);
        }

        MessageSent::dispatch($message);

        return $message->load('user.teammate');
    }
}