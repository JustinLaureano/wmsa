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
        return Inertia::render('Production/Requests/MaterialRequests', [
            'requests' => new MaterialRequestListCollection(
                $materialRequestRepository->getCurrentRequests()
            )
        ]);
    }
}
