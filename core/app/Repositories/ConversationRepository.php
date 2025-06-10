<?php

namespace App\Repositories;

use App\Domain\Messaging\DataTransferObjects\ConversationData;
use App\Models\Conversation;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class ConversationRepository
{
    public function getForParticipant(string $user_uuid): Collection
    {
        return Conversation::query()
            ->whereParticipant($user_uuid)
            ->with([
                'latestMessage' => [
                    'user.teammate',
                    'status'
                ],
                'participants',
            ])
            ->get();
    }

    /**
     * Ensure the given user is a participant in the given conversation.
     */
    public function ensureParticipant(string $conversationUuid, string $userUuid): void
    {
        Conversation::where('uuid', $conversationUuid)
            ->whereParticipant($userUuid)
            ->firstOrFail();
    }

    public function store(ConversationData $data): Conversation
    {
        return Conversation::query()->create($data->toArray());
    }

    public function getParticipantOptions(): Collection
    {
        $userUuid = request()->user()->uuid;

        // TODO: add conversation group names to list
        // and sort by teammate last name

        return User::query()
            ->with('teammate')
            ->when($userUuid, function ($query) use ($userUuid) {
                return $query->where('uuid', '!=', $userUuid);
            })
            ->get();
    }
}
