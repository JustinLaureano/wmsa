<?php

namespace Database\Factories;

use App\Domain\Production\Enums\RequestItemStatusEnum;
use App\Models\MaterialRequest;
use App\Models\Material;
use App\Models\Machine;
use App\Models\StorageLocation;
use App\Domain\Materials\Enums\UnitOfMeasureEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MaterialRequestItem>
 */
class MaterialRequestItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        if (rand(0, 1)) {
            $storageLocationUuid = StorageLocation::query()->inRandomOrder()->first()->uuid;
            $machineUuid = null;
        }
        else {
            $storageLocationUuid = null;
            $machineUuid = Machine::query()->inRandomOrder()->first()->uuid;
        }

        $material = Material::query()
            ->where('part_number', 'REGEXP', '^[0-9]{6}$')
            ->inRandomOrder()
            ->first();

        return [
            'material_request_uuid' => MaterialRequest::query()->inRandomOrder()->first()?->uuid || null,
            'material_uuid' => $material->uuid,
            'quantity_requested' => 1,
            'quantity_delivered' => 0,
            'unit_of_measure' => UnitOfMeasureEnum::CONT->value,
            'machine_uuid' => $machineUuid,
            'storage_location_uuid' => $storageLocationUuid,
            'request_item_status_code' => RequestItemStatusEnum::OPEN->value,
        ];
    }
}
