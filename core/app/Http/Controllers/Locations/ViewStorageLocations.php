<?php

namespace App\Http\Controllers\Locations;

use App\Http\Controllers\Controller;
use App\Http\Resources\Locations\StorageLocationCollection;
use App\Repositories\StorageLocationRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ViewStorageLocations extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        protected StorageLocationRepository $storageLocationRepository,
    ) {
        //
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        if ($request->expectsJson()) {
            return new StorageLocationCollection(
                $this->storageLocationRepository->filterPaginate()
            );
        }

        return Inertia::render('Locations/ViewStorageLocations', [
            'storageLocations' => new StorageLocationCollection(
                $this->storageLocationRepository->filterPaginate()
            )
        ]);
    }
}
