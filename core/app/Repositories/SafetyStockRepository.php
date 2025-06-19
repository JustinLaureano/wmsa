<?php

namespace App\Repositories;

use App\Models\Building;
use App\Models\Material;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

class SafetyStockRepository
{
    /**
     * Get the safety stock for each material in each building
     * and return as a flat report collection.
     */
    public function getSafetyStockReport() : LengthAwarePaginator
    {
        $buildings = (new BuildingRepository())->getBuildingIds();

        $caseStatements = $buildings->flatMap(function ($buildingId) {
                return [
                    DB::raw("MAX(CASE WHEN safety_stocks.building_id = {$buildingId} THEN safety_stocks.quantity END) as building_{$buildingId}_safety_stock"),
                    DB::raw("MAX(CASE WHEN safety_stocks.building_id = {$buildingId} THEN safety_stocks.unit_of_measure END) as building_{$buildingId}_uom"),
                    DB::raw("MAX(CASE WHEN safety_stocks.building_id = {$buildingId} THEN safety_stocks.notes END) as building_{$buildingId}_notes"),
                ];
            })
            ->toArray();

        $report = Material::query()
            ->join('safety_stocks', 'materials.uuid', '=', 'safety_stocks.material_uuid')
            ->select(array_merge(['materials.uuid', 'materials.part_number'], $caseStatements))
            // ->has('containers.location')
            ->with('containers.location.area.building')
            ->groupBy('materials.uuid', 'materials.part_number')
            ->paginate();

        return $report;
    }
}
