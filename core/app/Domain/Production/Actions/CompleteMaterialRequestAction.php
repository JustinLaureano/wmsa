<?php

namespace App\Domain\Production\Actions;

use App\Domain\Production\DataTransferObjects\UpdateMaterialRequestStatusData;
use App\Domain\Production\Jobs\CompleteMaterialRequest;

class CompleteMaterialRequestAction
{
    public function handle(UpdateMaterialRequestStatusData $data): void
    {
        CompleteMaterialRequest::dispatch($data);
    }
}