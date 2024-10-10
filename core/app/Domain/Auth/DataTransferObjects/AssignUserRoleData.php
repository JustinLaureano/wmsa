<?php

namespace App\Domain\Auth\DataTransferObjects;

use App\Models\Role;
use App\Models\User;
use Spatie\LaravelData\Data;

class AssignUserRoleData extends Data
{
    public function __construct(
        public readonly User $user,
        public readonly Role|string $role
    ) {

    }
}
