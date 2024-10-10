<?php

namespace App\Domain\Auth\DataTransferObjects;

use App\Models\Permission;
use App\Models\Role;
use Spatie\LaravelData\Data;

class AssignRolePermissionData extends Data
{
    public function __construct(
        public readonly Role $role,
        public readonly Permission $permission
    ) {

    }
}
