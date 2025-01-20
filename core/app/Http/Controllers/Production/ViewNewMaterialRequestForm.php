<?php

namespace App\Http\Controllers\Production;

use App\Http\Controllers\Controller;
use App\Http\Resources\Production\MachineOptionResource;
use App\Repositories\MachineRepository;
use Inertia\Inertia;

class ViewNewMaterialRequestForm extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(MachineRepository $machineRepository)
    {
        return Inertia::render('Production/Requests/NewMaterialRequestForm', [
            'machines' => MachineOptionResource::collection($machineRepository->get())
        ]);
    }
}
