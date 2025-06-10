<?php

namespace Database\Factories;

use App\Models\Material;
use App\Models\SortList;
use App\Models\SortListCustomer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SortList>
 */
class SortListFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $sortListCustomerUuid = SortListCustomer::query()
            ->inRandomOrder()
            ->value('uuid');

        $materialUuid = Material::query()
            ->whereNotIn(
                'uuid',
                SortList::query()->pluck('material_uuid')->toArray()
            )
            ->inRandomOrder()
            ->value('uuid');

        return [
            'sort_list_customer_uuid' => $sortListCustomerUuid,
            'material_uuid' => $materialUuid,
            'type' => 'internal',
            'status' => 'open',
            'reason' => fake()->sentence(),
            'percent' => fake()->randomElement([20, 50, 100, 100, 100]),
            'standard_time' => null,
            'cert' => null,
            'line_side_sort' => 0,
            'list_date' => null,
            'close_date' => null,
        ];
    }
}
