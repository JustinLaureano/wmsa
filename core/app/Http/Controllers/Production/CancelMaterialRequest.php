<?php

namespace App\Http\Controllers\Production;

use App\Domain\Production\Actions\CancelMaterialRequestAction;
use App\Domain\Production\DataTransferObjects\Requests\UpdateMaterialRequestStatusPayload;
use App\Domain\Production\Transformers\MaterialRequestTransformer;
use App\Http\Controllers\Controller;

class CancelMaterialRequest extends Controller
{
    public function __invoke(
        UpdateMaterialRequestStatusPayload $data,
        CancelMaterialRequestAction $action
    ) {
        $action->handle(
            MaterialRequestTransformer::updateStatusPayloadToActionData($data)
        );

        return response()->json([]);
    }
} 