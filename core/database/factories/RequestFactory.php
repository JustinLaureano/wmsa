<?php

namespace Database\Factories;

use App\Models\Location;
use App\Models\Part;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Request>
 */
class RequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'part_id' => Part::query()->inRandomOrder()->first()->id,
            'location_id' => Location::query()->inRandomOrder()->first()->id
        ];
    }
}
