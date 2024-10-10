<?php

namespace App\Domain\Auth\Actions;

use App\Domain\Auth\DataTransferObjects\CreateRoleData;
use App\Repositories\PermissionRepository;

class CreateRoleAction
{
    public function handle(CreateRoleData $data) : void
    {
        (new PermissionRepository)->createRole($data);
    }
}
