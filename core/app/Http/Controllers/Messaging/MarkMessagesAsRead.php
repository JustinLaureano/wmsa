<?php

namespace App\Http\Controllers\Messaging;

use App\Domain\Messaging\Actions\MarkMessagesAsReadAction;
use App\Domain\Messaging\DataTransferObjects\Requests\MarkMessagesAsReadPayload;
use App\Http\Controllers\Controller;

class MarkMessagesAsRead extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(MarkMessagesAsReadPayload $payload, MarkMessagesAsReadAction $action)
    {
        $action->handle($payload->conversation_uuid, $payload->user_uuid, $payload->read_at);
        return response()->json(['message' => 'Messages marked as read']);
    }
}
