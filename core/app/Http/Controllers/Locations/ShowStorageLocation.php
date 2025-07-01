<?php

namespace App\Http\Controllers\Locations;

use App\Http\Controllers\Controller;
use App\Http\Resources\Locations\StorageLocationResource;
use App\Models\StorageLocation;
use Inertia\Inertia;

class ShowStorageLocation extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StorageLocation $storageLocation)
    {
        return Inertia::render('Locations/ShowStorageLocation', [
            'location' => new StorageLocationResource($storageLocation),
        ]);
    }
}
