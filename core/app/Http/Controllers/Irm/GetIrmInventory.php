<?php

namespace App\Http\Controllers\Irm;

use App\Http\Controllers\Controller;
use App\Http\Resources\Irm\IrmChemicalInventoryResource;
use App\Repositories\IrmChemicalRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GetIrmInventory extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        protected IrmChemicalRepository $irmChemicalRepository,
    ) {
        //
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $inventory = $this->irmChemicalRepository->getInventory();

        return Inertia::render('Irm/Inventory/ShowInventory', [
            'inventory' => IrmChemicalInventoryResource::collection($inventory),
        ]);
    }
}
