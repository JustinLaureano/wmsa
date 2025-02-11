<?php

namespace Database\Factories;

use App\Domain\Production\DataTransferObjects\Actions\MaterialRequestActionData;
use App\Domain\Production\DataTransferObjects\Actions\MaterialRequestItemActionData;
use App\Domain\Production\Enums\RequestStatusEnum;
use App\Domain\Production\Enums\RequestItemStatusEnum;
use App\Models\MaterialRequestItem;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;
use Illuminate\Support\Lottery;

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
    public static function makeActionData(Carbon $requestedAt, string $requestStatus): MaterialRequestActionData
    {
        $multipleItems = Lottery::odds(1, 10)->choose();

        $factoryItems = $multipleItems
            ? MaterialRequestItem::factory()->count(rand(2, 4))->make(['material_request_uuid' => null])
            : collect([MaterialRequestItem::factory()->make(['material_request_uuid' => null])]);

        $items = collect();

        foreach ($factoryItems as $item) {
            logger()->info('Item: ' . $item);
            if ($requestStatus === RequestStatusEnum::COMPLETED->value) {
                $item->quantity_delivered = $item->quantity_requested;
                $item->request_item_status_code = RequestItemStatusEnum::COMPLETED->value;
            }
            else {
                $item->quantity_delivered = 0;
                $item->request_item_status_code = RequestItemStatusEnum::OPEN->value;
            }

            $items->push(new MaterialRequestItemActionData(
                material_uuid: $item->material_uuid,
                quantity_requested: $item->quantity_requested,
                quantity_delivered: $item->quantity_delivered,
                unit_of_measure: $item->unit_of_measure,
                machine_uuid: $item->machine_uuid,
                storage_location_uuid: $item->storage_location_uuid,
                request_item_status_code: $item->request_item_status_code,
            ));
        }

        return new MaterialRequestActionData(
            items: $items,
            material_request_status_code: $requestStatus,
            requester: User::query()->inRandomOrder()->first(),
            requested_at: $requestedAt
        );
    }
}
