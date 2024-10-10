<?php

namespace App\Repositories;

use App\Domain\Auth\DataTransferObjects\AssignRolePermissionData;
use App\Domain\Auth\DataTransferObjects\CreatePermissionData;
use App\Domain\Auth\DataTransferObjects\CreateRoleData;
use App\Models\Permission;
use App\Models\Role;

class PermissionRepository
{
    public function createRole(CreateRoleData $data) : Role
    {
        return Role::create($data->toArray());
    }

    public function createPermission(CreatePermissionData $data) : Permission
    {
        return Permission::create($data->toArray());
    }

    public function assignRolePermission(AssignRolePermissionData $data) : void
    {
        $data->role->givePermissionTo($data->permission);
    }
}
