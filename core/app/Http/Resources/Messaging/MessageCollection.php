<?php

namespace App\Http\Resources\Messaging;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MessageCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => MessageResource::collection($this->collection),
            'computed' => [
                'count' => $this->collection->count(),
            ],
            'meta' => [
                'timestamp' => now(),
            ],
        ];
    }
}