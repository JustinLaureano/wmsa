<?php

namespace Database\Factories;

use App\Models\ContainerLocationAllocation;
use App\Models\MaterialContainer;
use App\Models\StorageLocation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ContainerLocationAllocation>
 */
class ContainerLocationAllocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $storageLocationUuid = StorageLocation::query()
            ->whereNotIn(
                'uuid',
                ContainerLocationAllocation::query()->pluck('storage_location_uuid')->toArray()
            )
            ->value('uuid');

        $materialContainerUuid = MaterialContainer::query()
            ->whereNotIn(
                'uuid',
                ContainerLocationAllocation::query()->pluck('material_container_uuid')->toArray()
            )
            ->value('uuid');

        return [
            'storage_location_uuid' => $storageLocationUuid,
            'material_container_uuid' => $materialContainerUuid,
            'occurred_at' => now(),
        ];
    }
}
