<?php

namespace App\Http\Controllers\Materials;

use App\Http\Controllers\Controller;
use App\Http\Resources\Production\MaterialInventoryCollection;
use App\Repositories\MaterialRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GetMaterialInventory extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        protected MaterialRepository $materialRepository,
    ) {
        //
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        if ($request->expectsJson()) {
            return $this->materialRepository->filterInventoryPaginate();
        }

        return Inertia::render('Materials/Inventory/ShowMaterialInventory', [
            'inventory' => new MaterialInventoryCollection(
                $this->materialRepository->filterInventoryPaginate()
            )
        ]);
    }
}
