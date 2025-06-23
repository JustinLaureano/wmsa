<?php

namespace App\Http\Controllers\Materials;

use App\Http\Controllers\Controller;
use App\Http\Resources\Materials\SafetyStockReportCollection;
use App\Repositories\SafetyStockRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ViewSafetyStock extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        protected SafetyStockRepository $safetyStockRepository,
    ) {
        //
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        if ($request->expectsJson()) {
            return new SafetyStockReportCollection(
                $this->safetyStockRepository->getSafetyStockReportPaginated()
            );
        }

        return Inertia::render('Materials/ViewSafetyStock', [
            'safetyStock' => new SafetyStockReportCollection(
                $this->safetyStockRepository->getSafetyStockReportPaginated()
            )
        ]);
    }
}
