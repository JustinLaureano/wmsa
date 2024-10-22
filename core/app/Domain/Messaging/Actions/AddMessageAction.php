<?php

namespace App\Domain\Messaging\Actions;

use App\Domain\Messaging\DataTransferObjects\MessageData;
use App\Domain\Requests\Events\MessageSent;
use App\Repositories\MessageRepository;

class AddMessageAction
{
    public function handle(MessageData $data) : void
    {
        $message = (new MessageRepository)->store($data);

        // TODO: add message status for participants

        MessageSent::dispatch($message);
    }
}
