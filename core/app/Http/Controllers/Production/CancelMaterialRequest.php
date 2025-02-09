<?php

namespace App\Http\Controllers\Production;

use App\Domain\Production\Actions\CancelMaterialRequestAction;
use App\Domain\Production\DataTransferObjects\InitiateUpdateMaterialRequestStatusData;
use App\Domain\Production\Transformers\MaterialRequestStatusTransformer;
use App\Http\Controllers\Controller;

class CancelMaterialRequest extends Controller
{
    public function __invoke(
        InitiateUpdateMaterialRequestStatusData $data,
        CancelMaterialRequestAction $action
    ) {
        $action->handle(
            MaterialRequestStatusTransformer::initiateUpdateStatusToActionData($data)
        );

        return response()->json([]);
    }
} 