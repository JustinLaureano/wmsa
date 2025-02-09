<?php

namespace App\Http\Controllers\Production;

use App\Domain\Production\Actions\CompleteMaterialRequestAction;
use App\Domain\Production\DataTransferObjects\InitiateUpdateMaterialRequestStatusData;
use App\Domain\Production\Transformers\MaterialRequestTransformer;
use App\Http\Controllers\Controller;

class CompleteMaterialRequest extends Controller
{
    public function __invoke(
        InitiateUpdateMaterialRequestStatusData $data,
        CompleteMaterialRequestAction $action
    ) {
        $action->handle(MaterialRequestTransformer::initiateUpdateStatusToActionData($data));

        return response()->json([]);
    }
}
