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

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->teammates = Teammate::query()->get()->toArray();

        $this->conversations = [];
        $this->participants = [];
        $this->messages = [];

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
                    $hasMessages = Lottery::odds(1, 3)->choose();

                    if ( !$hasMessages ) continue;

                    $messageDate = $startDate->copy()
                        ->setHour(fake()->numberBetween(6, 9))
                        ->setMinute(fake()->numberBetween(0, 59))
                        ->setSecond(fake()->numberBetween(0, 59));

                    $numberOfMessages = fake()->numberBetween(1, 12);
                    $messagesSent = 0;

                    while ($messagesSent < $numberOfMessages) {
                        $senderId = Lottery::odds(1, 2)->choose()
                            ? $participant1['participant_id']
                            : $participant2['participant_id'];

                        $this->messages[] = [
                            'uuid' => Str::uuid(),
                            'conversation_uuid' => $conversation['uuid'],
                            'sender_id' => $senderId,
                            'sender_type' => ParticipantTypeEnum::TEAMMATE->value,
                            'content' => fake()->sentence(fake()->numberBetween(3, 14)),
                            'created_at' => $messageDate->toDateTimeString(),
                            'updated_at' => $messageDate->toDateTimeString()
                        ];

                        $hours = fake()->randomElement([0, 0, 0, 1]);
                        $minutes = fake()->numberBetween(4, 59);
                        $seconds = fake()->numberBetween(4, 59);

                        $messageDate->addHours($hours)
                            ->addMinutes($minutes)
                            ->addSeconds($seconds);

                        $messagesSent++;
                    }

                    $startDate->addDay();
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
    }
}
