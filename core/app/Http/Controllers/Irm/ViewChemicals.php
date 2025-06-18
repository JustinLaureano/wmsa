<?php

namespace App\Http\Controllers\Irm;

use App\Http\Controllers\Controller;
use App\Repositories\ViewIrmChemicalRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ViewChemicals extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        protected ViewIrmChemicalRepository $viewIrmChemicalRepository,
    ) {
        //
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        if ($request->expectsJson()) {
            return $this->viewIrmChemicalRepository->filterPaginate();
        }

        return Inertia::render('Irm/Chemicals/ViewChemicals', [
            'chemicals' => $this->viewIrmChemicalRepository->filterPaginate()
        ]);
    }
}
