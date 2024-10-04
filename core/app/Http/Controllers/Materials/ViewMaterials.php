<?php

namespace App\Http\Controllers\Materials;

use App\Http\Controllers\Controller;
use App\Repositories\MaterialRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ViewMaterials extends Controller
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
    public function __invoke(Request $request)
    {
        return Inertia::render('Materials/ViewMaterials', [
            'materials' => $this->materialRepository->paginate()
        ]);
    }
}
