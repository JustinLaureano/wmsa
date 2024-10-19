<?php

namespace App\Domain\Materials\Actions;

use App\Domain\Materials\DataTransferObjects\ContainerMovementData;
use App\Domain\Materials\Jobs\PerformContainerMovement;

class PerformContainerMovementAction
{
    public function handle(ContainerMovementData $data) : void
    {
        PerformContainerMovement::dispatch($data);
    }
}
