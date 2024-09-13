<?php

namespace Database\Factories;

use App\Models\BuildingType;
use App\Models\Organization;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Building>
 */
class BuildingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'organization_id' => Organization::firstOrFail()->id,
            'name' => fake()->words(2, true),
            'location' => fake()->city(),
            'building_type_id' => BuildingType::inRandomOrder()->firstOrFail()->id
        ];
    }
}
