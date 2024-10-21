<?php

namespace App\Http\Controllers\Materials;

use App\Domain\Materials\Actions\PerformContainerMovementAction;
use App\Domain\Materials\DataTransferObjects\InitiateContainerMovementData;
use App\Domain\Materials\Transformers\ContainerMovementTransformer;
use App\Http\Controllers\Controller;

class InitiateContainerMovement extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(InitiateContainerMovementData $data, PerformContainerMovementAction $action)
    {
        $action->handle(ContainerMovementTransformer::initiateToData($data));

        return response()->json([]);
    }
}
