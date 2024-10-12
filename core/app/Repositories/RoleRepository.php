<?php

namespace App\Repositories;

use App\Domain\Auth\DataTransferObjects\AssignRolePermissionData;
use App\Models\Role;

class RoleRepository
{
    /**
     * Assign a permission to a role using the provided data.
     */
    public function assignPermission(AssignRolePermissionData $data) : void
    {
        $data->role->givePermissionTo($data->permission);
    }

    /**
     * Find a role by the name.
     */
    public function findByName(string $name) : Role|null
    {
        return Role::query()->where('name', $name)->first();
    }
}