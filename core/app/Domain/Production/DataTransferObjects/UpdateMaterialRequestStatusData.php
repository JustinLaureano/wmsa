<?php

namespace App\Domain\Production\DataTransferObjects;

use App\Models\MaterialRequest;
use Spatie\LaravelData\Data;

class UpdateMaterialRequestStatusData extends Data
{
    public function __construct(
        public readonly MaterialRequest $materialRequest,
        public readonly string $material_request_status_code
    ) {
    }
} 