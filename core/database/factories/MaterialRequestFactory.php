<?php

namespace Database\Factories;

use App\Domain\Materials\Enums\UnitOfMeasureEnum;
use App\Domain\Production\DataTransferObjects\MaterialRequestActionData;
use App\Domain\Production\Enums\RequestStatusEnum;
use App\Models\Machine;
use App\Models\Material;
use App\Models\StorageLocation;
use App\Models\User;
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
            'requester_user_uuid' => User::query()->inRandomOrder()->first()->uuid,
            'requested_at' => now(),
        ];
    }

    /**
     * Define the state for a closed material request.
     */
    public static function makeActionData(): MaterialRequestActionData
    {
        return new MaterialRequestActionData(
            material: Material::query()->inRandomOrder()->first(),
            quantity: 1,
            unit_of_measure: UnitOfMeasureEnum::CONT->value,
            machine: Machine::query()->inRandomOrder()->first(),
            location: StorageLocation::query()->inRandomOrder()->first(),
            material_request_status_code: RequestStatusEnum::OPEN->value,
            requester: User::query()->inRandomOrder()->first(),
            requested_at: now(),
        );
    }
}
