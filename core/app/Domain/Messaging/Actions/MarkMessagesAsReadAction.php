<?php

namespace App\Domain\Messaging\Actions;

use Carbon\Carbon;
use App\Repositories\MessageStatusRepository;

class MarkMessagesAsReadAction
{
    public function handle(string $conversationUuid, string $userUuid, string $readAt): void
    {
        $repository = new MessageStatusRepository;

        $repository->markMessagesAsRead($conversationUuid, $userUuid, new Carbon($readAt));
    }
}