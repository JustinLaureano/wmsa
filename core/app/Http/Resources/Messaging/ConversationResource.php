<?php

namespace App\Http\Resources\Messaging;

use App\Domain\Messaging\DataTransferObjects\ParticipantConversationsData;
use App\Domain\Messaging\Enums\ParticipantTypeEnum;
use App\Models\ConversationParticipant;
use App\Models\Teammate;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConversationResource extends JsonResource
{
    protected string $participant_id;

    protected string $participant_type;

    protected Teammate|null $teammate;

    protected User|null $user;

    protected Collection $otherParticipants;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'uuid' => $this->uuid,
            'attributes' => $this->resource->getAttributes(),
            'relations' => [
                'latest_message' => $this->latestMessage,
                'participants' => $this->participants
            ],
            'computed' => [
                'avatar_initials' => $this->getParticipantInitials(),
                'title' => $this->getTitle(),
                'subject' => $this->getSubject(),
                'latest_message_date' => $this->getLatestMessageDate(),
            ]
        ];
    }

    /**
     * Get the avatar initials to use for the conversation list option.
     */
    protected function getParticipantInitials() : string
    {
        if ( $this->getOtherParticipants()->count() === 1 ) {
            $op = $this->otherParticipants->first();

            if (
                $op->participant_type == ParticipantTypeEnum::TEAMMATE->value ||
                $op->participant_type == ParticipantTypeEnum::USER->value
            ) {
                $firstInitial = $op->participant->first_name
                    ? substr($op->participant->first_name, 0, 1)
                    : '';
                $lastInitial = $op->participant->last_name
                    ? substr($op->participant->last_name, 0, 1)
                    : '';

                return $firstInitial . $lastInitial;
            }
        }

        return '';
    }

    /**
     * Get the title text for the conversation list option.
     */
    protected function getTitle() : string
    {
        if ( $this->getOtherParticipants()->count() === 1 ) {
            $op = $this->otherParticipants->first();

            if (
                $op->participant_type == ParticipantTypeEnum::TEAMMATE->value ||
                $op->participant_type == ParticipantTypeEnum::USER->value
            ) {
                $firstName = $op->participant->first_name
                    ? $op->participant->first_name
                    : '';
                $lastName = $op->participant->last_name
                    ? $op->participant->last_name
                    : '';

                if ($firstName && $lastName) {
                    return $lastName .', '. $firstName;
                }
                else if ($firstName) {
                    return $firstName;
                }
                else if ($lastName) {
                    return $lastName;
                }

                return '';
            }
        }
        else {
            return $this->getOtherParticipants()
                ->reduce(function (string $carry, ConversationParticipant $participant) {
                    if (
                        $participant->participant_type == ParticipantTypeEnum::TEAMMATE->value ||
                        $participant->participant_type == ParticipantTypeEnum::USER->value
                    ) {
                        $name = $participant->participant->first_name
                            ? $participant->participant->first_name
                            : $participant->participant->last_name;
                    }
                    else {
                        $name = 'Uknown';
                    }

                    return $carry ? "$carry, $name" : $name;
                }, '');
        }

        return '';
    }

    /**
     * Get the subject line text for the conversation list option.
     */
    protected function getSubject() : string
    {

        // TODO: if new message from another participant, display "New Message"
        // if () {

        // }
        if ( $this->participantSentLatestMessage() ) {
            return ucfirst(__('you')) .': '. substr($this->latestMessage->content, 0, 35);
        }
        else {
            return substr($this->latestMessage->content, 0, 40);
        }

        return 'New Message';
    }

    /**
     * Return a formatted date string of the date of the latest message.
     */
    protected function getLatestMessageDate() : string
    {
        return (new Carbon( $this->latestMessage->created_at ))->format('n/j');
    }

    protected function getOtherParticipants()
    {
        if ( !isset($this->otherParticipants) ) {
            $this-> otherParticipants = $this->participants
                ->reject(function (ConversationParticipant $participant) {
                    if (
                        $participant->participant_type == ParticipantTypeEnum::TEAMMATE->value &&
                        $participant->participant_id == $this->teammate?->clock_number
                    ) {
                        return true;
                    }

                    if (
                        $participant->participant_type == ParticipantTypeEnum::USER->value &&
                        $participant->participant_id == $this->user?->guid
                    ) {
                        return true;
                    }

                    return false;
                });
        }

        return $this->otherParticipants;
    }

    protected function participantSentLatestMessage() : bool
    {
        return (
                $this->latestMessage->sender_type == ParticipantTypeEnum::TEAMMATE->value &&
                $this->latestMessage->sender_id == $this->teammate?->clock_number
            ) ||
            (
                $this->latestMessage->sender_type == ParticipantTypeEnum::USER->value &&
                $this->latestMessage->sender_id == $this->user?->guid
            );
    }

    /**
     * Set the data of the active participant requesting
     * the conversation resource. This will be used to
     * detemermine which participant records are other
     * people and which ones are the current user.
     */
    public function setRequestParticipant(
        ParticipantConversationsData $participantData,
        Teammate|null $teammate,
        User|null $user
    ) : void
    {
        $this->participant_id = $participantData->participant_id;
        $this->participant_type = $participantData->participant_type;
        $this->teammate = $teammate;
        $this->user = $user;
    }
}
