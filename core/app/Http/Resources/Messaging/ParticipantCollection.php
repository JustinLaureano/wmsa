<?php

namespace App\Http\Resources\Messaging;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ParticipantCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection->map(function ($participant) {
                    $user = $participant->user;
                    $teammate = $user->teammate;

                    return [
                        'uuid' => $participant->uuid,
                        'user_uuid' => $user->uuid,
                        'name' => $teammate
                            ? "{$teammate->last_name}, {$teammate->first_name}"
                            : $user->teammate_clock_number,
                    ];
                })
                ->all(),
            'computed' => [
                'count' => $this->collection->count(),
            ],
            'meta' => [
                'timestamp' => now(),
            ],
        ];
    }
}