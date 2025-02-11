<?php

namespace Database\Factories;

use App\Domain\Production\DataTransferObjects\MaterialRequestActionData;
use App\Domain\Production\DataTransferObjects\MaterialRequestItemActionData;
use App\Domain\Production\Enums\RequestStatusEnum;
use App\Models\MaterialRequestItem;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MaterialRequest>
 */
class MaterialRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'material_request_status_code' => RequestStatusEnum::OPEN->value,
            'requester_user_uuid' => User::query()->inRandomOrder()->first()->uuid,
            'requested_at' => now(),
        ];
    }

    /**
     * Define the state for a closed material request.
     */
    public static function makeActionData(): MaterialRequestActionData
    {
        $factoryItems = MaterialRequestItem::factory()->count(3)->make();

        $items = [];
        foreach ($factoryItems as $item) {
            // TODO: fix issue with not having material request uuid yet?
            $items[] = new MaterialRequestItemActionData(
                material_uuid: $item->material_uuid,
                quantity_requested: $item->quantity_requested,
                quantity_delivered: $item->quantity_delivered,
                unit_of_measure: $item->unit_of_measure,
                machine_uuid: $item->machine_uuid,
                storage_location_uuid: $item->storage_location_uuid,
                request_item_status_code: $item->request_item_status_code,
            );
        }

        return new MaterialRequestActionData(
            items: $items,
            material_request_status_code: RequestStatusEnum::OPEN->value,
            requester: User::query()->inRandomOrder()->first(),
            requested_at: now()
        );
    }
}
