<?php

namespace App\Domain\Production\DataTransferObjects\Actions;

use App\Models\User;
use Carbon\Carbon;
use Spatie\LaravelData\Data;
use Illuminate\Support\Collection;

class MaterialRequestActionData extends Data
{
    /**
     * @param Collection<MaterialRequestItemActionData> $items
     */
    public function __construct(
        public readonly Collection $items,
        public readonly string $material_request_status_code,
        public readonly User $requester,
        public readonly Carbon $requested_at
    )
    {

    }
}