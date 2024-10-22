<?php

namespace App\Http\Controllers\Messaging;

use App\Domain\Messaging\Actions\AddMessageAction;
use App\Domain\Messaging\DataTransferObjects\AddMessageRequestData;
use App\Http\Controllers\Controller;

class AddMessage extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(AddMessageRequestData $data, AddMessageAction $action)
    {
        $message = $action->handle($data);

        return response()
            ->json([
                'message' => $message
            ]);
    }
}
