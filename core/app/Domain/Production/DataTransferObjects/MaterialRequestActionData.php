<?php

namespace App\Domain\Production\DataTransferObjects;

use App\Models\Material;
use App\Models\Machine;
use App\Models\StorageLocation;
use App\Models\User;
use Carbon\Carbon;
use Spatie\LaravelData\Data;

class MaterialRequestActionData extends Data
{
    public function __construct(
        public readonly Material $material,
        public readonly int $quantity,
        public readonly string $unit_of_measure,
        public readonly Machine $machine,
        public readonly StorageLocation $location,
        public readonly string $material_request_status_code,
        public readonly User $requester,
        public readonly Carbon $requested_at
    )
    {

    }
}