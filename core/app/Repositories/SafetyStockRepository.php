<?php

namespace App\Repositories;

use App\Domain\Materials\Enums\UnitOfMeasureEnum;
use App\Models\Material;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class SafetyStockRepository
{
    /**
     * Get the safety stock for each material in each building
     * and return as a paginated flat report collection.
     */
    public function getSafetyStockReportPaginated(string|null $materialTypeCode = null) : LengthAwarePaginator
    {
        $report = $this->getSafetyStockReportQuery($materialTypeCode)->paginate();
        $report = $this->calculateOnHandQuantity($report);

        return $report;
    }

    /**
     * Get the safety stock for each material in each building
     * and return as a flat report collection.
     */
    public function getSafetyStockReport(string|null $materialTypeCode = null) : Collection
    {
        $report = $this->getSafetyStockReportQuery($materialTypeCode)->get();
        $report = $this->calculateOnHandQuantity($report);

        return $report;
    }

    /**
     * Get the base query for the safety stock report.
     */
    private function getSafetyStockReportQuery(string|null $materialTypeCode) : Builder
    {
        // Will query and return all materials with safety stocks configured.
        return Material::query()
            ->join(
                'safety_stocks',
                'materials.uuid',
                '=',
                'safety_stocks.material_uuid'
            )
            ->select(array_merge([
                    'materials.uuid',
                    'materials.material_type_code',
                    'materials.part_number'
                ], 
                $this->getBuildingCaseStatements())
            )
            ->when($materialTypeCode, function ($query) use ($materialTypeCode) {
                $query->where('materials.material_type_code', $materialTypeCode);
            })
            ->with('containers.location.area.building')
            ->groupBy(
                'materials.uuid',
                'materials.part_number',
                'materials.material_type_code'
            );
    }

    /**
     * Get the case statements for each building to calculate the
     * safety stock, unit of measure, and notes for the material in that building.
     * This is used to create a flat report collection.
     */
    private function getBuildingCaseStatements() : array
    {
        $buildings = (new BuildingRepository())->getBuildingIds();

        // This will create query statements for each building to calculate the
        // safety stock, unit of measure, and notes for the material in that building.
        // This is used to create a flat report collection.
        $caseStatements = $buildings->flatMap(function ($buildingId) {
                return [
                    DB::raw("MAX(
                        CASE
                            WHEN safety_stocks.building_id = {$buildingId}
                            THEN safety_stocks.quantity 
                        END) as building_{$buildingId}_safety_stock"
                    ),
                    DB::raw("MAX(
                        CASE
                            WHEN safety_stocks.building_id = {$buildingId}
                            THEN safety_stocks.unit_of_measure
                        END) as building_{$buildingId}_uom"
                    ),
                    DB::raw("MAX(
                        CASE
                            WHEN safety_stocks.building_id = {$buildingId}
                            THEN safety_stocks.notes
                        END) as building_{$buildingId}_notes"
                    ),
                ];
            })
            ->toArray();

        return $caseStatements;
    }

    /**
     * Calculate the on hand quantity for each building.
     * This is used to create a flat report collection.
     */
    private function calculateOnHandQuantity(Collection|LengthAwarePaginator $report) : Collection|LengthAwarePaginator
    {
        $buildings = (new BuildingRepository())->getBuildingIds();

        // This will map the report to add the on hand quantity for each building.
        // It will also set the unit of measure for the current building if it does not
        // have one. If it does not have one, it will use the first unit of measure
        // it finds. If it does not have a unit of measure, it will use EA as the
        // default unit of measure.
        $report->map(function ($item) use ($buildings) {
            $defaultUom = null;
            $unitOfMeasure = null;

            foreach ($buildings as $buildingId) {
                // Instantiate the on hand quantity for the current building.
                $item['building_'.$buildingId.'_on_hand'] = 0;

                // Grab the unit of measure for the current building
                $unitOfMeasure = $item['building_'.$buildingId.'_uom'];

                // If we do not yet have a default uom to fall back to,
                // then we can use the first unit of measure we find.
                if (!$defaultUom && $unitOfMeasure) {
                    $defaultUom = $unitOfMeasure;
                }

                // If the current building does not have a unit of measure,
                // then we can use the default unit of measure if we have one.
                // If we do not have a default unit of measure, then we can
                // fall back to using EA as the default unit of measure.
                if (!$unitOfMeasure) {
                    if ($defaultUom) {
                        $unitOfMeasure = $defaultUom;
                    }
                    else {
                        $unitOfMeasure = strtoupper(UnitOfMeasureEnum::EA->value);
                    }

                    // Set the unit of measure for the current building
                    $item['building_'.$buildingId.'_uom'] = $unitOfMeasure;
                }
            }

            foreach ($item->containers as $container) {
                // If the unit of measure is CONT (container), then we just count
                // each individual container as 1. All other unit of measures
                // are counted as the quantity of the item.
                if ($unitOfMeasure === strtoupper(UnitOfMeasureEnum::CONT->value)) {
                    $item['building_'.$container->location->area->building_id.'_on_hand'] += 1;
                }
                else {
                    $item['building_'.$container->location->area->building_id.'_on_hand'] += $container->quantity;
                }
            }

            return $item;
        });

        return $report;
    }
}
