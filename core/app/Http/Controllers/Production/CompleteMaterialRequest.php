<?php

namespace App\Http\Controllers\Production;

use App\Domain\Production\Actions\CompleteMaterialRequestAction;
use App\Domain\Production\DataTransferObjects\Requests\UpdateMaterialRequestStatusPayload;
use App\Domain\Production\Transformers\MaterialRequestTransformer;
use App\Http\Controllers\Controller;

class CompleteMaterialRequest extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(
        UpdateMaterialRequestStatusPayload $data,
        CompleteMaterialRequestAction $action
    ) {
        $action->handle(MaterialRequestTransformer::updateStatusPayloadToActionData($data));

        return response()->json([]);
    }
}
