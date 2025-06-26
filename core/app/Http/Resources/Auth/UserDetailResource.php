<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserDetailResource extends JsonResource
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
                'teammate' => $this->teammate,
                'domainAccount' => $this->domainAccount,
                'roles' => $this->roles,
                'permissions' => $this->permissions,
                'settings' => $this->settings,
            ],
            'computed' => [
                'clock_number' => $this->teammate_clock_number,
                'domain_account_guid' => $this->domain_account_guid,
                'first_name' => $this->teammate?->first_name,
                'last_name' => $this->teammate?->last_name,
                'display_name' => $this->domainAccount?->display_name,
                'title' => $this->domainAccount?->title,
                'description' => $this->domainAccount?->description,
                'department' => $this->domainAccount?->department,
                'email' => $this->domainAccount?->email,
                'hire_date' => $this->teammate?->hire_date,
                'user_uuid' => $this->uuid,
            ]
        ];
    }
}
