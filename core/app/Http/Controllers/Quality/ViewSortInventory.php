<?php

namespace App\Http\Controllers\Quality;

use App\Http\Controllers\Controller;
use App\Http\Resources\Quality\ViewSortListInventoryCollection;
use App\Http\Resources\Materials\MaterialAutocompleteResource;
use App\Repositories\MaterialRepository;
use App\Repositories\ViewSortListInventoryRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ViewSortInventory extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        protected MaterialRepository $materialRepository,
        protected ViewSortListInventoryRepository $viewSortListInventoryRepository
    ) {
        //
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        if ($request->expectsJson()) {
            return new ViewSortListInventoryCollection(
                $this->viewSortListInventoryRepository->filterPaginate()
            );
        }

        return Inertia::render('Quality/Sort/ViewSortInventory', [
            'inventory' => new ViewSortListInventoryCollection(
                $this->viewSortListInventoryRepository->filterPaginate()
            ),
            'materialOptions' => MaterialAutocompleteResource::collection(
                $this->materialRepository->getMaterialInventoryOptions()
            )
        ]);
    }
}
