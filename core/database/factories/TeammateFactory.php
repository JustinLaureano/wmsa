<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class TeammateFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'clock_number' => '6000',
            'organization_id' => 1,
            'first_name' => 'process',
            'last_name' => 'worker',
            'hire_date' => fake()->dateTimeBetween(startDate: '-10 years'),
        ];
    }
}
