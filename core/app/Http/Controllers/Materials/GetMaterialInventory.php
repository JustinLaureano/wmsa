<?php

namespace App\Http\Controllers\Materials;

use App\Http\Controllers\Controller;
use App\Repositories\ViewMaterialInventoryRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GetMaterialInventory extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        protected ViewMaterialInventoryRepository $viewMaterialInventoryRepository,
    ) {
        //
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        if ($request->expectsJson()) {
            return $this->viewMaterialInventoryRepository->filterPaginate();
        }

        return Inertia::render('Materials/Inventory/ShowInventory', [
            'inventory' => $this->viewMaterialInventoryRepository->filterPaginate()
        ]);
    }
}
