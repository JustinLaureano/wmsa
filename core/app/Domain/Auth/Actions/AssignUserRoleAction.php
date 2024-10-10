<?php

namespace App\Domain\Auth\Actions;

use App\Domain\Auth\DataTransferObjects\AssignUserRoleData;
use App\Repositories\UserRepository;

class AssignUserRoleAction
{
    public function handle(AssignUserRoleData $data) : void
    {
        (new UserRepository)->assignRole($data);
    }
}
