<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Lottery;
use Illuminate\Support\Str;

class ConversationSeeder extends Seeder
{
    protected array $users;
    protected array $conversations;
    protected array $participants;
    protected array $messages;
    protected array $statuses;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->users = User::query()->with('teammate')->get()->toArray();
        $this->conversations = [];
        $this->participants = [];
        $this->messages = [];
        $this->statuses = [];

        $this->generateConversations();
        $this->storeConversations();
    }

    protected function generateConversations(): void
    {
        foreach ($this->users as $i => $user1) {
            for ($j = $i + 1; $j < count($this->users); $j++) {
                $user2 = $this->users[$j];

                $hasConversation = Lottery::odds(1, 4)->choose();
                if (!$hasConversation) {
                    continue;
                }

                $startDate = now()->subDays(fake()->numberBetween(2, 30));
                $conversation = [
                    'uuid' => Str::uuid(),
                    'group_conversation' => false,
                    'created_at' => $startDate,
                    'updated_at' => $startDate,
                ];

                $this->conversations[] = $conversation;

                // Add participants
                $this->participants[] = [
                    'uuid' => Str::uuid(),
                    'conversation_uuid' => $conversation['uuid'],
                    'user_uuid' => $user1['uuid'],
                    'created_at' => $startDate,
                    'updated_at' => $startDate,
                ];

                $this->participants[] = [
                    'uuid' => Str::uuid(),
                    'conversation_uuid' => $conversation['uuid'],
                    'user_uuid' => $user2['uuid'],
                    'created_at' => $startDate,
                    'updated_at' => $startDate,
                ];

                $needsMessages = true;
                $messageDate = $startDate->copy();

                while ($messageDate->lt(now()->subDay())) {
                    $messageDate->addDay();

                    $hasMessages = $needsMessages || Lottery::odds(1, 3)->choose();
                    $needsMessages = false;

                    if (!$hasMessages) {
                        continue;
                    }

                    $numberOfMessages = fake()->numberBetween(1, 8);
                    $messagesSent = 0;

                    while ($messagesSent < $numberOfMessages) {
                        $senderIsUser1 = Lottery::odds(1, 2)->choose();
                        $senderUuid = $senderIsUser1 ? $user1['uuid'] : $user2['uuid'];

                        $messageTime = $messageDate->copy()
                            ->setHour(fake()->numberBetween(6, 20))
                            ->setMinute(fake()->numberBetween(0, 59))
                            ->setSecond(fake()->numberBetween(0, 59));

                        $message = [
                            'uuid' => Str::uuid(),
                            'conversation_uuid' => $conversation['uuid'],
                            'user_uuid' => $senderUuid,
                            'content' => fake()->sentence(fake()->numberBetween(3, 14)),
                            'created_at' => $messageTime,
                            'updated_at' => $messageTime,
                        ];

                        $this->messages[] = $message;

                        // Determine if the other participant has read the message
                        $daysInPast = abs($messageTime->diffInDays(now()));
                        $isRead = match (true) {
                            $daysInPast < 2 => Lottery::odds(3, 10)->choose(),
                            $daysInPast < 3 => Lottery::odds(6, 10)->choose(),
                            $daysInPast < 5 => Lottery::odds(7, 10)->choose(),
                            $daysInPast < 10 => Lottery::odds(8, 10)->choose(),
                            $daysInPast < 15 => Lottery::odds(9, 10)->choose(),
                            default => Lottery::odds(19, 20)->choose(),
                        };

                        $readerUuid = $senderIsUser1 ? $user2['uuid'] : $user1['uuid'];
                        if ($isRead) {
                            $readAt = $messageTime->copy()
                                ->addHours($this->getFakeHours())
                                ->addMinutes($this->getFakeMinutes())
                                ->addSeconds($this->getFakeSeconds());

                            $this->statuses[] = [
                                'uuid' => Str::uuid(),
                                'message_uuid' => $message['uuid'],
                                'user_uuid' => $readerUuid,
                                'is_read' => true,
                                'read_at' => $readAt
                            ];
                        }
                        else {
                            $this->statuses[] = [
                                'uuid' => Str::uuid(),
                                'message_uuid' => $message['uuid'],
                                'user_uuid' => $readerUuid,
                                'is_read' => false,
                                'read_at' => null
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

    protected function storeConversations(): void
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

        $messages->chunk(500)->each(function ($chunk) {
            DB::table('messages')->insert($chunk->toArray());
        });

        $statuses = collect($this->statuses)
            ->sortBy('read_at')
            ->values();

        $statuses->chunk(500)->each(function ($chunk) {
            DB::table('message_status')->insert($chunk->toArray());
        });
    }

    protected function getFakeHours(): int
    {
        return fake()->randomElement([0, 0, 0, 0, 1, 1, 2]);
    }

    protected function getFakeMinutes(): int
    {
        return fake()->numberBetween(4, 59);
    }

    protected function getFakeSeconds(): int
    {
        return fake()->numberBetween(4, 59);
    }
}