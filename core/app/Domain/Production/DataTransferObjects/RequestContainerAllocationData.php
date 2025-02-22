<?php

namespace App\Domain\Production\DataTransferObjects;

use Spatie\LaravelData\Data;

class RequestContainerAllocationData extends Data
{
    public function __construct(
        public readonly string $material_request_item_uuid,
        public readonly string $material_container_uuid,
        public readonly bool $in_transit,
        public readonly string|null $transit_user_uuid,
        public readonly bool $is_reserved
    )
    {

    }
}
