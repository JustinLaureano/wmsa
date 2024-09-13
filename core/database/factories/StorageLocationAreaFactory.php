<?php

namespace Database\Factories;

use App\Models\Building;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StorageLocationArea>
 */
class StorageLocationAreaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'building_id' => Building::first()->id,
            'name' => 'COMP',
            'description' => 'Compound Racks',
            'sap_storage_location_group' => '1000',
        ];
    }
}
