<?php

namespace App\Domain\Production\Actions;

use App\Domain\Production\DataTransferObjects\Actions\UpdateMaterialRequestStatusActionData;
use App\Domain\Production\Jobs\CancelMaterialRequest;

class CancelMaterialRequestAction
{
    public function handle(UpdateMaterialRequestStatusActionData $data): void
    {
        CancelMaterialRequest::dispatch($data->materialRequest->uuid);
    }
} 