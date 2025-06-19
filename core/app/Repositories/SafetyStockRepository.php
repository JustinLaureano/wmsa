<?php

namespace App\Repositories;

use App\Models\Building;
use App\Models\Material;
use Illuminate\Support\Facades\DB;

class SafetyStockRepository
{
    /**
     * Get the safety stock for each material in each building
     * and return as a flat report collection.
     */
    public function getSafetyStockReport() : array
    {
        $buildings = Building::all();
        $caseStatements = $buildings->flatMap(function ($building) {
                return [
                    DB::raw("MAX(CASE WHEN safety_stocks.building_id = {$building->id} THEN safety_stocks.quantity END) as building_{$building->id}_quantity"),
                    DB::raw("MAX(CASE WHEN safety_stocks.building_id = {$building->id} THEN safety_stocks.uom END) as building_{$building->id}_uom"),
                ];
            })
            ->toArray();

        $report = Material::leftJoin('safety_stocks', 'materials.uuid', '=', 'safety_stocks.material_uuid')
            ->select(array_merge(['materials.uuid', 'materials.part_number'], $caseStatements))
            ->groupBy('materials.uuid', 'materials.part_number')
            ->get();

        return $report;
    }
}
