<?php

namespace App\Http\Controllers\Messaging;

use App\Http\Controllers\Controller;
use App\Http\Resources\Messaging\ParticipantAutocompleteResource;
use App\Repositories\ConversationRepository;

class GetParticipantOptions extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        protected ConversationRepository $conversationRepository,
    ) {
        //
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $options = ParticipantAutocompleteResource::collection($this->conversationRepository->getParticipantOptions());

        return $options;
    }
}
