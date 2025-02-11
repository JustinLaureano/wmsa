<?php

namespace Database\Factories;

use App\Models\DeliveryDocument;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DeliveryDocument>
 */
class DeliveryDocumentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => Str::uuid(),
            'delivery_number' => $this->faker->unique()->numerify('00#0000###'),
            'ship_to_number' => $this->faker->numerify('3000000###'),
            'ship_to_name' => $this->faker->company(),
            'request_date' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'delivery_posted_at' => $this->faker->optional()->dateTimeBetween('-1 month', 'now'),
        ];
    }
}