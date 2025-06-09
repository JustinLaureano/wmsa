<?php

namespace App\Http\Resources\Messaging;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ParticipantAutocompleteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->uuid,
            'label' => $this->teammate->last_name . ', ' . $this->teammate->first_name,
        ];
    }
}
