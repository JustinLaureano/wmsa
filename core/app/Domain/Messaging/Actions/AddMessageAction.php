<?php

namespace App\Domain\Messaging\Actions;

use App\Domain\Messaging\DataTransferObjects\AddMessageRequestData;
use App\Domain\Messaging\DataTransferObjects\MessageData;
use App\Domain\Messaging\Events\MessageSent;
use App\Models\Message;
use App\Repositories\MessageRepository;
use Illuminate\Support\Str;

class AddMessageAction
{
    public function handle(AddMessageRequestData $data) : Message
    {
        $message = (new MessageRepository)
            ->store(new MessageData(
                uuid: Str::uuid(),
                conversation_uuid: $data->conversation_uuid,
                sender_id: $data->sender_id,
                sender_type: $data->sender_type,
                content: $data->content
            ));

        // TODO: add message status for participants

        MessageSent::dispatch($message);

        return $message;
    }
}
