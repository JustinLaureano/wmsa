<?php

namespace App\Domain\Production\DataTransferObjects;

use App\Models\User;
use Carbon\Carbon;
use Spatie\LaravelData\Data;

class MaterialRequestActionData extends Data
{
    /**
     * @param array<MaterialRequestItemActionData> $items
     */
    public function __construct(
        public readonly array $items,
        public readonly string $material_request_status_code,
        public readonly User $requester,
        public readonly Carbon $requested_at
    )
    {

    }
}