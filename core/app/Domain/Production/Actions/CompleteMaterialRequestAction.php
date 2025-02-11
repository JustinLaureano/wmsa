<?php

namespace App\Domain\Production\Actions;

use App\Domain\Production\DataTransferObjects\Actions\UpdateMaterialRequestStatusActionData;
use App\Domain\Production\Jobs\CompleteMaterialRequest;

class CompleteMaterialRequestAction
{
    public function handle(UpdateMaterialRequestStatusActionData $data): void
    {
        CompleteMaterialRequest::dispatch($data);
    }
}