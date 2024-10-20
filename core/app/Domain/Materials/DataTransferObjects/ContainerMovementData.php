<?php

namespace App\Domain\Materials\DataTransferObjects;

use App\Domain\Materials\Contracts\HandlerContract;
use App\Models\MaterialContainer;
use App\Models\StorageLocation;
use Carbon\Carbon;
use Spatie\LaravelData\Data;

class ContainerMovementData extends Data
{
    public function __construct(
        public readonly MaterialContainer $container,
        public readonly StorageLocation $location,
        public readonly HandlerContract $handler,
        public readonly Carbon $moved_at,
    ) {

    }
}
