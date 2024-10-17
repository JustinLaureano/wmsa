<?php

namespace Database\Factories;

use App\Models\MaterialContainer;
use App\Models\StorageLocation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ContainerLocation>
 */
class ContainerLocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $container = MaterialContainer::query()->doesntHave('location')->inRandomOrder()->first();
        $location = StorageLocation::inRandomOrder()->first();

        return [
            'material_container_uuid' => $container->uuid,
            'storage_location_uuid' => $location->uuid,
        ];
    }
}
