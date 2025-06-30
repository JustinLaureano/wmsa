<?php

namespace App\Http\Controllers\Auth;

use App\Domain\Auth\Actions\SetSessionBuildingAction;
use App\Domain\Auth\DataTransferObjects\Requests\SetSessionBuildingPayload;
use App\Http\Controllers\Controller;
use App\Http\Resources\Locations\BuildingResource;
use App\Repositories\BuildingRepository;

class SetSessionBuildingController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        protected BuildingRepository $buildingRepository,
    ) {
        //
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(SetSessionBuildingPayload $payload, SetSessionBuildingAction $action)
    {
        $building = $action->handle($payload->building_id);

        return new BuildingResource($building);
    }
}
