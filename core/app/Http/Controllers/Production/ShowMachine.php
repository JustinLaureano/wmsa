<?php

namespace App\Http\Controllers\Production;

use App\Http\Controllers\Controller;
use App\Http\Resources\Production\MachineResource;
use App\Models\Machine;
use Inertia\Inertia;

class ShowMachine extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Machine $machine)
    {
        return Inertia::render('Production/Machines/ShowMachine', [
            'machine' => new MachineResource($machine),
        ]);
    }
}
