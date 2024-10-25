<?php

namespace App\Http\Resources\Messaging;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConversationResource extends JsonResource
{
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
                'title' => $this->getTitle(),
                'subject' => $this->getSubject(),
                'latest_message_date' => $this->getLatestMessageDate(),
            ]
        ];
    }

    protected function getTitle() : string
    {
        // TODO:
        // strip participants of current participant
        // if only one participant left, use full name
        // if more, cycle through names and use syntax: firstname, firstname, firstname

        $title = $this->participants[0]->participant->last_name .', '. $this->participants[0]->participant->first_name;

        return $title;
    }

    protected function getSubject() : string
    {
        // TODO:
        // if last message unread - show "New Message"
        // if not, show sender name and content of last message
        //   ex:
        //      You: I just sent you an email.
        //      Joshua: Somebody just called for you.

        $subject = 'New Message';

        return $subject;
    }

    protected function getLatestMessageDate() : string
    {
        return (new Carbon( $this->latestMessage->created_at ))->format('n/j');
    }
}
