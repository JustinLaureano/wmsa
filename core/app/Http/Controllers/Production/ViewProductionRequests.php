<?php

namespace App\Http\Controllers\Production;

use App\Http\Controllers\Controller;
use App\Http\Resources\Production\MaterialRequestListCollection;
use App\Repositories\MaterialRequestRepository;
use Inertia\Inertia;

class ViewProductionRequests extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(MaterialRequestRepository $materialRequestRepository)
    {
        $building_id = request()->input('building_id');
        $type = request()->input('type');

        return Inertia::render('Production/Requests/MaterialRequests', [
            'requests' => new MaterialRequestListCollection(
                $materialRequestRepository->getCurrentRequests(
                    building_id: $building_id,
                    type: $type
                )
            )
        ]);
    }
}
