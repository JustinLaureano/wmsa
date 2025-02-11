<?php

namespace App\Http\Controllers\Production;

use App\Domain\Production\Actions\CreateMaterialRequestAction;
use App\Domain\Production\DataTransferObjects\InitiateMaterialRequestData;
use App\Domain\Production\Transformers\MaterialRequestTransformer;
use App\Http\Controllers\Controller;

class CreateMaterialRequest extends Controller
{
    /**
     * Handle the incoming request.
     * 
     * TODO: simplify all of this dto stuff
     */
    public function __invoke(InitiateMaterialRequestData $data, CreateMaterialRequestAction $action)
    {
        $action->handle(MaterialRequestTransformer::initiateToActionData($data));

        return response()->json([]);
    }
}
