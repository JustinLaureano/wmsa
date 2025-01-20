<?php

namespace App\Domain\Production\Actions;

use App\Domain\Production\DataTransferObjects\MaterialRequestActionData;
use App\Domain\Production\Jobs\CreateNewMaterialRequest;

class CreateMaterialRequestAction
{
    public function handle(MaterialRequestActionData $data) : void
    {
        CreateNewMaterialRequest::dispatch($data);
    }
}
