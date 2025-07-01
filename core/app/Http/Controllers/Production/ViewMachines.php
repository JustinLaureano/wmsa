<?php

namespace App\Http\Controllers\Production;

use App\Http\Controllers\Controller;
use App\Http\Resources\Production\ViewMachineResource;
use App\Repositories\ViewMachineRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ViewMachines extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        protected ViewMachineRepository $machineRepository,
    ) {
        //
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        if ($request->expectsJson()) {
            return ViewMachineResource::collection($this->machineRepository->filterPaginate());
        }

        return Inertia::render('Production/Machines/ViewMachines', [
            'machines' => ViewMachineResource::collection($this->machineRepository->filterPaginate())
        ]);
    }
}
