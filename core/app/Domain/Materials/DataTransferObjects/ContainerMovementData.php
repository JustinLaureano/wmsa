<?php

namespace App\Domain\Materials\DataTransferObjects;

use App\Models\MaterialContainer;
use App\Models\StorageLocation;
use App\Models\User;
use Carbon\Carbon;
use Spatie\LaravelData\Data;

class ContainerMovementData extends Data
{
    public function __construct(
        public readonly MaterialContainer $container,
        public readonly StorageLocation $location,
        public readonly User $handler,
        public readonly Carbon $moved_at,
    ) {

    }
}
