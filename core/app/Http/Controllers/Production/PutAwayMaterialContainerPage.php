<?php

namespace App\Http\Controllers\Production;

use App\Http\Controllers\Controller;
use App\Models\MaterialContainer;
use Inertia\Inertia;

class PutAwayMaterialContainerPage extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(MaterialContainer $materialContainer)
    {
        return Inertia::render('Production/PutAway/StoreContainer', [
            'materialContainer' => $materialContainer,
        ]);
    }
}
