<?php

namespace App\Domain\Auth\Actions;

use App\Domain\Auth\DataTransferObjects\RemoveUserRoleData;
use App\Repositories\UserRepository;

class RemoveUserRoleAction
{
    public function handle(RemoveUserRoleData $data) : void
    {
        (new UserRepository)->removeRole($data);
    }
}
