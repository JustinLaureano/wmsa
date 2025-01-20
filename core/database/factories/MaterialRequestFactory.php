<?php

namespace Database\Factories;

use App\Domain\Materials\Enums\RequestStatusEnum;
use App\Domain\Materials\Enums\UnitOfMeasureEnum;
use App\Models\Machine;
use App\Models\Material;
use App\Models\StorageLocation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MaterialRequest>
 */
class MaterialRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        if (rand(0, 1)) {
            $storageLocationUuid = StorageLocation::query()->inRandomOrder()->first()->uuid;
            $machineUuid = null;
        }
        else {
            $storageLocationUuid = null;
            $machineUuid = Machine::query()->inRandomOrder()->first()->uuid;
        }

        return [
            'material_uuid' => Material::query()->inRandomOrder()->first()->uuid,
            'quantity' => 1,
            'unit_of_measure' => UnitOfMeasureEnum::CONT->value,
            'machine_uuid' => $machineUuid,
            'storage_location_uuid' => $storageLocationUuid,
            'material_request_status_code' => RequestStatusEnum::OPEN->value,
            'requested_at' => now(),
        ];
    }
}
