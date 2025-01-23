<?php

namespace Database\Factories;

use App\Models\StorageLocationArea;
use App\Models\StorageLocationType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StorageLocation>
 */
class StorageLocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = StorageLocationType::inRandomOrder()->first();

        return [
            'name' => fake()->bothify('#-????-#-#-#-#'),
            'storage_location_area_id' => StorageLocationArea::inRandomOrder()->first()->id,
            'storage_location_type_id' => $type->id,
            'barcode' => fake()->sha1(),
            'max_containers' => $type->default_max_containers,
            'restrict_request_allocations' => 0,
            'disabled' => 0,
            'reservable' => 1,
        ];
    }
}
