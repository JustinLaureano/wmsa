<?php

namespace App\Http\Controllers\Messaging;

use App\Domain\Messaging\Actions\StartConversationAction;
use App\Domain\Messaging\DataTransferObjects\StartConversationRequestData;
use App\Http\Controllers\Controller;

class StartConversation extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StartConversationRequestData $data, StartConversationAction $action)
    {
        $conversation = $action->handle($data);

        return response()
            ->json([
                'conversation' => $conversation
            ]);
    }
}
