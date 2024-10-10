<?php

namespace App\Domain\Auth\Actions;

use App\Domain\Auth\DataTransferObjects\AssignRolePermissionData;
use App\Repositories\PermissionRepository;

class AssignRolePermissionAction
{
    public function handle(AssignRolePermissionData $data) : void
    {
        (new PermissionRepository)->assignRolePermission($data);
    }
}
