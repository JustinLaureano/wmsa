<?php

namespace Database\Factories;

use App\Models\Building;
use App\Models\MachineType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Machine>
 */
class MachineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->bothify('Line ## Press ##');

        return [
            'uuid' => Str::uuid(),
            'name' => $name,
            'barcode' => $name,
            'building_id' => Building::inRandomOrder()->first()->id,
            'machine_type_id' => MachineType::inRandomOrder()->first()->id
        ];
    }
}
