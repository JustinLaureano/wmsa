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
                'latest_message_date' => $this->latestMessage->created_at,
                'unread_messages' => $this->getUnreadMessages(),
            ],
        ];
    }

    protected function getTitle(): string
    {
        $participants = $this->participants->filter(function ($participant) {
            return $participant->user->user_uuid !== $this->participantData->user_uuid;
        });

        if ($participants->count() === 1) {
            $teammate = $participants->first()->teammate;

            return $teammate ? "{$teammate->last_name}, {$teammate->first_name}" : $teammate->clock_number;
        }

        $names = $participants->map(function ($participant) {
                $teammate = $participant->teammate;

                return $teammate->first_name .' '. $teammate->last_name[0];
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

        $sender = $this->latestMessage->user;
        $teammate = $sender->teammate;
        $senderName = $sender->uuid === $this->participantData->user_uuid
            ? 'You'
            : "{$teammate->first_name} {$teammate->last_name}";

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