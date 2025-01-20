<?php

namespace Database\Factories;

use App\Models\MaterialContainer;
use App\Models\MaterialRequest;
use App\Models\RequestContainerAllocation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RequestContainerAllocation>
 */
class RequestContainerAllocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $materialRequestUuid = MaterialRequest::query()
            ->whereNotIn(
                'uuid',
                RequestContainerAllocation::query()->pluck('material_request_uuid')->toArray()
            )
            ->value('uuid');

        $materialContainerUuid = MaterialContainer::query()
            ->whereNotIn(
                'uuid',
                RequestContainerAllocation::query()->pluck('material_container_uuid')->toArray()
            )
            ->value('uuid');

        return [
            'material_request_uuid' => $materialRequestUuid,
            'material_container_uuid' => $materialContainerUuid,
            'occurred_at' => now(),
        ];
    }
}
