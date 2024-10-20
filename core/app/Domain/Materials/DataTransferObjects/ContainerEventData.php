<?php

namespace App\Domain\Materials\DataTransferObjects;

use Carbon\Carbon;
use Spatie\LaravelData\Data;

class ContainerEventData extends Data
{
    public function __construct(
        public readonly string $material_container_uuid,
        public readonly string $event_type,
        public readonly array $event_data,
        public readonly Carbon $occurred_at,
    ) {

    }
}
