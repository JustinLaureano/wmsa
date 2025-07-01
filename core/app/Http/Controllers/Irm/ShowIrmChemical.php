<?php

namespace App\Http\Controllers\Irm;

use App\Http\Controllers\Controller;
use App\Http\Resources\Irm\IrmChemicalResource;
use App\Models\IrmChemical;
use Inertia\Inertia;

class ShowIrmChemical extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(IrmChemical $chemical)
    {
        return Inertia::render('Irm/Chemicals/ShowChemical', [
            'chemical' => new IrmChemicalResource($chemical),
        ]);
    }
}
