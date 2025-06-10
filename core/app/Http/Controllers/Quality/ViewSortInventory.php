<?php

namespace App\Http\Controllers\Quality;

use App\Http\Controllers\Controller;
use App\Http\Resources\Quality\ViewSortListInventoryCollection;
use App\Repositories\ViewSortListInventoryRepository;
use Inertia\Inertia;

class ViewSortInventory extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(ViewSortListInventoryRepository $viewSortListInventoryRepository)
    {
        return Inertia::render('Quality/Sort/ViewSortInventory', [
            'inventory' => new ViewSortListInventoryCollection(
                $viewSortListInventoryRepository->filterPaginate()
            )
        ]);
    }
}
