<?php

namespace App\Domain\Production\Actions;

use App\Domain\Production\DataTransferObjects\Actions\MaterialRequestActionData;
use App\Domain\Production\Jobs\CreateNewMaterialRequest;

class CreateMaterialRequestAction
{
    /**
     * Dispatches a queued job to create a new material
     * request using the provided action data.
     */
    public function handle(MaterialRequestActionData $data) : void
    {
        CreateNewMaterialRequest::dispatch($data);
    }
}
