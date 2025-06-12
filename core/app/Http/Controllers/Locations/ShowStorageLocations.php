<?php

namespace App\Http\Controllers\Locations;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class ShowStorageLocations extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        return Inertia::render('Locations/ShowStorageLocations');
    }
}
