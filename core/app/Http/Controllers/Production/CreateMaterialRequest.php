<?php

namespace App\Http\Controllers\Production;

use App\Domain\Production\Actions\CreateMaterialRequestAction;
use App\Domain\Production\DataTransferObjects\Requests\CreateMaterialRequestPayload;
use App\Domain\Production\Transformers\MaterialRequestTransformer;
use App\Http\Controllers\Controller;

class CreateMaterialRequest extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CreateMaterialRequestPayload $data, CreateMaterialRequestAction $action)
    {
        $action->handle(MaterialRequestTransformer::createPayloadToActionData($data));

        return response()->json([]);
    }
}
