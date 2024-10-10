<?php

namespace App\Domain\Auth\Actions;

use App\Domain\Auth\DataTransferObjects\CreatePermissionData;
use App\Repositories\PermissionRepository;

class CreatePermissionAction
{
    public function handle(CreatePermissionData $data) : void
    {
        (new PermissionRepository)->createPermission($data);
    }
}
