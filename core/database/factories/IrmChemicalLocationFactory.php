<?php

namespace Database\Factories;

use App\Models\IrmChemical;
use App\Models\StorageLocation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\IrmChemicalLocation>
 */
class IrmChemicalLocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => $this->getUuid(),
            'irm_chemical_uuid' => IrmChemical::query()->inRandomOrder()->first()->uuid,
            'storage_location_uuid' => StorageLocation::query()->inRandomOrder()->first()->uuid,
            'quantity' => $this->faker->numberBetween(1, 5000),
        ];
    }
}
