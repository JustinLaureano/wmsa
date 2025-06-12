<?php

namespace App\Http\Controllers\Materials;

use App\Domain\Materials\Actions\UpdateContainerQuantityAction;
use App\Domain\Materials\DataTransferObjects\Requests\UpdateContainerQuantityPayload;
use App\Domain\Materials\DataTransferObjects\Actions\UpdateContainerQuantityActionData;
use App\Http\Controllers\Controller;
use App\Http\Resources\Materials\MaterialContainerResource;

class UpdateContainerQuantity extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateContainerQuantityPayload $data, UpdateContainerQuantityAction $action)
    {
        $container = $action->handle(UpdateContainerQuantityActionData::fromPayload($data));

        return new MaterialContainerResource($container);
    }
}
