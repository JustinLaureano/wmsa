<?php

namespace App\Http\Controllers\Materials;

use App\Http\Controllers\Controller;
use App\Repositories\ViewContainerInventoryRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GetContainerInventory extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        protected ViewContainerInventoryRepository $viewContainerInventoryRepository,
    ) {
        //
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        if ($request->expectsJson()) {
            return $this->viewContainerInventoryRepository->filterPaginate();
        }

        return Inertia::render('Materials/Inventory/ShowContainerInventory', [
            'inventory' => $this->viewContainerInventoryRepository->filterPaginate()
        ]);
    }
}
