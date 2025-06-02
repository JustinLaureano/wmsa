<?php

namespace App\Http\Resources\Messaging;

use App\Domain\Messaging\DataTransferObjects\ParticipantConversationsData;
use App\Repositories\MessageRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConversationResource extends JsonResource
{
    protected ParticipantConversationsData $participantData;

    public function setParticipantData(ParticipantConversationsData $participantData): self
    {
        $this->participantData = $participantData;
        return $this;
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->uuid,
            'attributes' => [
                'uuid' => $this->uuid,
                'group_conversation' => $this->group_conversation,
            ],
            'relations' => [
                'latest_message' => new MessageResource($this->whenLoaded('latestMessage')),
                'participants' => ParticipantCollection::make($this->whenLoaded('participants')),
            ],
            'computed' => [
                'title' => $this->getTitle(),
                'subject' => $this->getSubject(),
                'latest_message_date' => $this->getLatestMessageDate(),
                'unread_messages' => $this->getUnreadMessages(),
            ],
        ];
    }

    protected function getTitle(): string
    {
        $participants = $this->participants->filter(function ($participant) {
            return $participant->user->uuid !== $this->participantData->user_uuid;
        });

        if ($participants->count() === 1) {
            $user = $participants->first()->user;
            $teammate = $user->teammate;

            return $teammate ? "{$teammate->last_name}, {$teammate->first_name}" : $user->teammate_clock_number;
        }

        $names = $participants->map(function ($participant) {
                $user = $participant->user;
                $teammate = $user->teammate;

                return $teammate ? $teammate->first_name : $user->first_name;
            })
            ->filter()
            ->implode(', ');

        return $names ?: 'Group Conversation';
    }

    protected function getSubject(): string
    {
        if (!$this->latestMessage) {
            return 'No Messages';
        }

        $isUnread = !$this->latestMessage->status
            ->where('user_uuid', $this->participantData->user_uuid)
            ->first()
            ?->is_read;

        if ($isUnread) {
            return 'New Message';
        }

        $sender = $this->latestMessage->user;
        $teammate = $sender->teammate;
        $senderName = $sender->uuid === $this->participantData->user_uuid
            ? 'You'
            : ($teammate ? "{$teammate->first_name} {$teammate->last_name}" : $sender->first_name . ' ' . $sender->last_name);

        return "{$senderName}: {$this->latestMessage->content}";
    }

    protected function getLatestMessageDate(): ?string
    {
        return $this->latestMessage
            ? (new Carbon($this->latestMessage->created_at))->format('n/j')
            : null;
    }

    protected function getUnreadMessages(): int
    {
        return (new MessageRepository)
            ->getConversationUnreadMessagesCount(
                conversationUuid: $this->uuid,
                userUuid: $this->participantData->user_uuid
            );
    }
}