<?php

namespace App\Domain\Production\Actions;

use App\Domain\Production\DataTransferObjects\UpdateMaterialRequestStatusData;
use App\Domain\Production\Jobs\CancelMaterialRequest;

class CancelMaterialRequestAction
{
    public function handle(UpdateMaterialRequestStatusData $data): void
    {
        CancelMaterialRequest::dispatch($data->uuid);
    }
} 