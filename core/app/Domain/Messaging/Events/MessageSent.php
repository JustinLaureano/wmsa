<?php

namespace App\Domain\Messaging\Events;

use App\Models\ConversationParticipant;
use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public Message $message)
    {
        //
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        $this->message->load('conversation');

        $participantChannels = $this->message->conversation->participants
            ->reduce(function (array $carry, ConversationParticipant $p) {
                $channel = 'conversation.'. $p->participant_type .'.'. $p->participant_id;
                $carry[] = new PrivateChannel($channel);

                return $carry;
            }, []);

        return array_merge([
            //
        ], $participantChannels);
    }

    /**
     * The event's broadcast name.
     */
    public function broadcastAs(): string
    {
        return 'message.sent';
    }
}
