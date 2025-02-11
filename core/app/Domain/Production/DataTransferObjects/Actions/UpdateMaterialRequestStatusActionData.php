<?php

namespace App\Domain\Production\DataTransferObjects\Actions;

use App\Models\MaterialRequest;
use Spatie\LaravelData\Data;

class UpdateMaterialRequestStatusActionData extends Data
{
    public function __construct(
        public readonly MaterialRequest $materialRequest,
        public readonly string $material_request_status_code
    ) {
    }
} 