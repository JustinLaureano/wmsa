<?php

namespace Database\Factories;

use App\Models\MaterialType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Material>
 */
class MaterialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $materialTypeCode = MaterialType::query()
            ->where('code', '<>', 'CBP')
            ->inRandomOrder()
            ->first()
            ->code;

        return [
            'uuid' => Str::uuid(),
            'material_number' => fake()->bothify('##??###?##'),
            'part_number' => fake()->bothify('######'),
            'description' => fake()->words(asText: true),
            'material_type_code' => $materialTypeCode,
            'base_quantity' => 1,
            'base_unit_of_measure' => 'EA',
        ];
    }
}
