<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'organization_id' => $this->organization_id,
            'teammate_clock_number' => $this->teammate_clock_number,
            'domain_account_guid' => $this->domain_account_guid,
            'first_name' => $this->teammate->first_name,
            'last_name' => $this->teammate->last_name,
            'display_name' => $this->teammate->domainAccount?->display_name,
            'title' => $this->teammate->domainAccount?->title,
            'description' => $this->teammate->domainAccount?->description,
            'department' => $this->teammate->domainAccount?->department,
            'email' => $this->teammate->domainAccount?->email,
            'hire_date' => $this->teammate->hire_date,
            'created_at' => $this->created_at,
        ];
    }
}
