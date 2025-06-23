<?php

namespace App\Http\Controllers\Materials;

use App\Http\Controllers\Controller;
use App\Http\Resources\Materials\SafetyStockReportResource;
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
            return SafetyStockReportResource::collection(
                $this->safetyStockRepository->getSafetyStockReportPaginated(
                    materialTypeCode: $request->material_type_code
                )
            );
        }

        return Inertia::render('Materials/ViewSafetyStock', [
            'safetyStock' => SafetyStockReportResource::collection(
                $this->safetyStockRepository->getSafetyStockReportPaginated(
                    materialTypeCode: $request->material_type_code
                )
            )
        ]);
    }
}
