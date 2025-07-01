<?php

namespace App\Http\Controllers\Materials;

use App\Http\Controllers\Controller;
use App\Models\MaterialContainer;
use App\Http\Resources\Materials\MaterialContainerResource;
use Inertia\Inertia;

class ShowMaterialContainer extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(MaterialContainer $materialContainer)
    {
        return Inertia::render('Materials/ShowContainer', [
            'container' => new MaterialContainerResource($materialContainer)
        ]);
    }
}
