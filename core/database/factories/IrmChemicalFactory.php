<?php

namespace Database\Factories;

use App\Models\Material;
use App\Models\StorageLocation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\IrmChemical>
 */
class IrmChemicalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $lotQuantity = $this->faker->numberBetween(100, 5000);
        $divisor = $this->faker->numberBetween(1, 50);
        $unitQuantity = $lotQuantity / $divisor;

        return [
            'uuid' => $this->getUuid(),
            'material_uuid' => Material::query()->inRandomOrder()->first()->uuid,
            'lot_quantity' => $lotQuantity,
            'unit_quantity' => $unitQuantity,
            'assigned_storage_location_uuid' => StorageLocation::query()->inRandomOrder()->first()->uuid,
            'drop_off_storage_location_uuid' => StorageLocation::query()->inRandomOrder()->first()->uuid,
        ];
    }
}
