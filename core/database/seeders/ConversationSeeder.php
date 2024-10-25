<?php

namespace Database\Seeders;

use App\Domain\Messaging\Enums\ParticipantTypeEnum;
use App\Models\Teammate;
use Database\Seeders\Traits\Timestamps;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Lottery;
use Illuminate\Support\Str;

class ConversationSeeder extends Seeder
{
    use Timestamps;

    protected array $teammates;
    protected array $conversations;
    protected array $participants;
    protected array $messages;
    protected array $statuses;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->teammates = Teammate::query()->with('user')->get()->toArray();

        $this->conversations = [];
        $this->participants = [];
        $this->messages = [];
        $this->statuses = [];

        $this->generateConversations();
        $this->storeConversations();
    }

    protected function generateConversations() : void
    {
        for ($i = 0; $i < count($this->teammates); $i++) {
            for ($j = $i + 1; $j < count($this->teammates); $j++) {

                $hasConversation = Lottery::odds(1, 3)->choose();

                if ( !$hasConversation ) continue;

                $now = now();
                $startDate = now()->subDays(fake()->numberBetween(2, 45));

                $conversation = [
                    'uuid' => Str::uuid(),
                    'group_conversation' => false,
                    'created_at' => $startDate->toDateTimeString(),
                    'updated_at' => $startDate->toDateTimeString()
                ];

                $this->conversations[] = $conversation;

                $teammate1 = $this->teammates[$i];
                $teammate2 = $this->teammates[$j];

                $participant1 = [
                    'uuid' => Str::uuid(),
                    'conversation_uuid' => $conversation['uuid'],
                    'participant_id' => $teammate1['clock_number'],
                    'participant_type' => ParticipantTypeEnum::TEAMMATE->value,
                    'created_at' => $startDate->toDateTimeString(),
                    'updated_at' => $startDate->toDateTimeString()
                ];

                $participant2 = [
                    'uuid' => Str::uuid(),
                    'conversation_uuid' => $conversation['uuid'],
                    'participant_id' => $teammate2['clock_number'],
                    'participant_type' => ParticipantTypeEnum::TEAMMATE->value,
                    'created_at' => $startDate->toDateTimeString(),
                    'updated_at' => $startDate->toDateTimeString()
                ];

                $this->participants[] = $participant1;
                $this->participants[] = $participant2;

                while ($startDate->lt($now)) {
                    $startDate->addDay();

                    $hasMessages = Lottery::odds(1, 3)->choose();

                    if ( !$hasMessages ) continue;

                    $messageDate = $startDate->copy()
                        ->setHour(fake()->numberBetween(6, 9))
                        ->setMinute(fake()->numberBetween(0, 59))
                        ->setSecond(fake()->numberBetween(0, 59));

                    $numberOfMessages = fake()->numberBetween(1, 12);
                    $messagesSent = 0;

                    while ($messagesSent < $numberOfMessages) {
                        $senderIsParticipant1 = Lottery::odds(1, 2)->choose();
                        $useUser = Lottery::odds(1, 5)->choose();

                        $senderId = $senderIsParticipant1
                            ? $participant1['participant_id']
                            : $participant2['participant_id'];
                        $senderType = ParticipantTypeEnum::TEAMMATE->value;

                        if ($useUser) {
                            $user = $senderIsParticipant1
                                ? $teammate1['user']
                                : $teammate2['user'];

                            if ($user) {
                                $senderId = $user['guid'];
                                $senderType = ParticipantTypeEnum::USER->value;
                            }
                        }

                        $message = [
                            'uuid' => Str::uuid(),
                            'conversation_uuid' => $conversation['uuid'],
                            'sender_id' => $senderId,
                            'sender_type' => $senderType,
                            'content' => fake()->sentence(fake()->numberBetween(3, 14)),
                            'created_at' => $messageDate->toDateTimeString(),
                            'updated_at' => $messageDate->toDateTimeString()
                        ];

                        $this->messages[] = $message;

                        // randomly determine if message has been read by other participants
                        $daysInPast = abs( $messageDate->diffInDays($now) );

                        if ( $daysInPast < 2 ) {
                            $isRead = Lottery::odds(3, 10)->choose();
                        }
                        if ( $daysInPast < 3 ) {
                            $isRead = Lottery::odds(6, 10)->choose();
                        }
                        else if ( $daysInPast < 5 ) {
                            $isRead = Lottery::odds(7, 10)->choose();
                        }
                        else if ( $daysInPast < 10 ) {
                            $isRead = Lottery::odds(8, 10)->choose();
                        }
                        else if ( $daysInPast < 15 ) {
                            $isRead = Lottery::odds(9, 10)->choose();
                        }
                        else {
                            $isRead = Lottery::odds(19, 20)->choose();
                        }

                        if ($isRead) {
                            $reader = $senderIsParticipant1
                                ? $participant2
                                : $participant1;

                            $readAt = $messageDate->copy()
                                ->addHours($this->getFakeHours())
                                ->addMinutes($this->getFakeMinutes())
                                ->addSeconds($this->getFakeSeconds());

                            $this->statuses[] = [
                                'uuid' => Str::uuid(),
                                'message_uuid' => $message['uuid'],
                                'participant_id' => $reader['participant_id'],
                                'participant_type' => $reader['participant_type'],
                                'is_read' => 1,
                                'read_at' => $readAt
                            ];
                        }

                        $messageDate->addHours($this->getFakeHours())
                            ->addMinutes($this->getFakeMinutes())
                            ->addSeconds($this->getFakeSeconds());

                        $messagesSent++;
                    }
                }
            }
        }
    }

    protected function storeConversations() : void
    {
        $conversations = collect($this->conversations)
            ->sortBy('created_at')
            ->values()
            ->toArray();

        DB::table('conversations')->insert($conversations);
        DB::table('conversation_participants')->insert($this->participants);

        $messages = collect($this->messages)
            ->sortBy('created_at')
            ->values();

        $messages->chunk(500)->each(function($chunk) {
            DB::table('messages')->insert($chunk->toArray());
        });

        $statuses = collect($this->statuses)
            ->sortBy('read_at')
            ->values();

        $statuses->chunk(500)->each(function($chunk) {
            DB::table('message_status')->insert($chunk->toArray());
        });
    }

    protected function getFakeHours() : int
    {
        return fake()->randomElement([0, 0, 0, 0, 1, 1, 2]);
    }

    protected function getFakeMinutes() : int
    {
        return fake()->numberBetween(4, 59);
    }

    protected function getFakeSeconds() : int
    {
        return fake()->numberBetween(4, 59);
    }
}
