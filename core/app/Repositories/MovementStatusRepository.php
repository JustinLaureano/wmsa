<?php

namespace App\Repositories;

use App\Domain\Materials\Enums\MovementStatus as MovementStatusEnum;
use App\Models\MovementStatus;

class MovementStatusRepository
{
    public function findByCode(MovementStatusEnum $status) : MovementStatus
    {
        return MovementStatus::query()->whereCode($status)->first();
    }
}