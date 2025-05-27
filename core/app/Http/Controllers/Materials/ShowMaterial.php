<?php

namespace App\Http\Controllers\Materials;

use App\Http\Controllers\Controller;
use App\Repositories\MaterialRepository;
use Inertia\Inertia;

class ShowMaterial extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        protected MaterialRepository $materialRepository,
    ) {
        //
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(string $uuid)
    {
        $material = $this->materialRepository->findByUuid($uuid);

        if (!$material) {
            return redirect()->route('materials');
        }

        return Inertia::render('Materials/ShowMaterial', [
            'material' => $material
        ]);
    }
}
