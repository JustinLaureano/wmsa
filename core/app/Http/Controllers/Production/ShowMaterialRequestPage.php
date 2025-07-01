<?php

namespace App\Http\Controllers\Production;

use App\Http\Controllers\Controller;
use App\Http\Resources\Production\MaterialRequestResource;
use App\Models\MaterialRequest;
use Inertia\Inertia;

class ShowMaterialRequestPage extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(MaterialRequest $materialRequest)
    {
        return Inertia::render('Production/Requests/ShowMaterialRequest', [
            'materialRequest' => new MaterialRequestResource($materialRequest),
        ]);
    }
}
