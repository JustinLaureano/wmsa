<?php

namespace Database\Seeders;

use App\Domain\Locations\Enums\StorageLocationTypeEnum;
use App\Domain\Production\Actions\CreateMaterialRequestAction;
use App\Domain\Production\Enums\RequestStatusEnum;
use App\Domain\Production\Enums\RequestTypeEnum;
use App\Models\Building;
use App\Models\Machine;
use App\Models\StorageLocation;
use Database\Factories\MaterialRequestFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Lottery;

class MaterialRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $requestedAt = now()->subDays(7);
        $now = now();

        while ($requestedAt->lt($now)) {

            $requestStatus = RequestStatusEnum::OPEN->value;

            if ($requestedAt->copy()->diffInMinutes($now) > 90) {
                $isClosed = Lottery::odds(8, 10)->choose();

                $requestStatus = $isClosed
                    ? RequestStatusEnum::COMPLETED->value
                    : RequestStatusEnum::CANCELLED->value;
            }

            if ($requestedAt->copy()->diffInMinutes($now) <= 90 && $requestedAt->copy()->diffInMinutes($now) > 25) {
                $isNotOpen = Lottery::odds(2, 10)->choose();
                $isClosed = Lottery::odds(8, 10)->choose();

                if ($isNotOpen) {
                    $requestStatus = $isClosed
                        ? RequestStatusEnum::COMPLETED->value
                        : RequestStatusEnum::CANCELLED->value;
                }
            }

            // Determine a building for the material request
            $building = Building::query()
                ->whereIn('id', [1, 2, 3])
                ->inRandomOrder()
                ->first()
                ->id;

            // Determine if the material request is for a machine or a storage location
            // based on the building and what is realistically available for that building.
            // The number of items is also determined here based on what is typical for 
            // the building and machine or storage location. This should give us more
            // realistic mock material requests to work with.
            if ($building === 1) {
                $machineRequest = Lottery::odds(9, 10)->choose();

                if ($machineRequest) {
                    $machineUuid = Machine::query()
                        ->where('building_id', $building)
                        ->inRandomOrder()
                        ->first()
                        ->uuid;
                    $storageLocationUuid = null;
                    $items = 1;
                    $type = RequestTypeEnum::TRANSFER->value;
                }
                else {
                    $phosphateRequest = Lottery::odds(1, 8)->choose();

                    if ($phosphateRequest) {
                        $storageLocationUuid = StorageLocation::query()
                            ->whereHas('area', function (Builder $query) use ($building) {
                                $query->where([
                                    ['building_id', $building],
                                    ['name', 'LIKE', '%PHOSPHATE%'],
                                ]);
                            })
                            ->inRandomOrder()
                            ->first()
                            ->uuid;
                        $type = RequestTypeEnum::PHOSPHATE->value;
                    }
                    else {
                        $storageLocationUuid = StorageLocation::query()
                            ->whereHas('area', function (Builder $query) use ($building) {
                                $query->where('building_id', $building);
                            })
                            ->whereHas('type', function (Builder $query) {
                                $query->where('name', StorageLocationTypeEnum::FLOOR->value);
                            })
                            ->inRandomOrder()
                            ->first()
                            ->uuid;
                        $type = RequestTypeEnum::TRANSFER->value;
                    }
                    $machineUuid = null;
                    $items = 1;
                }

            }
            else if ($building === 2) {
                $machineRequest = Lottery::odds(1, 2)->choose();

                if ($machineRequest) {
                    $machineUuid = Machine::query()
                        ->where('building_id', $building)
                        ->inRandomOrder()
                        ->first()
                        ->uuid;
                    $storageLocationUuid = null;
                    $items = 1;
                    $type = RequestTypeEnum::TRANSFER->value;
                }
                else {
                    // pick storage location
                    $storageLocationUuid = StorageLocation::query()
                        ->whereHas('area', function (Builder $query) use ($building) {
                            $query->where('building_id', $building);
                        })
                        ->where('name', 'Shipping Dock')
                        ->inRandomOrder()
                        ->first()
                        ->uuid;
                    $machineUuid = null;
                    $items = rand(1, 4);
                    $type = RequestTypeEnum::SHIPPING->value;
                }
            }
            else if ($building === 3) {
                // Needs to be location request for defiance building
                $machineUuid = null;
                $storageLocationUuid = StorageLocation::query()
                    ->whereHas('area', function (Builder $query) use ($building) {
                        $query->where('building_id', $building);
                    })
                    ->whereHas('type', function (Builder $query) {
                        $query->where('name', StorageLocationTypeEnum::FLOOR->value);
                    })
                    ->inRandomOrder()
                    ->first()
                    ->uuid;
                $items = rand(1, 3);
                $type = RequestTypeEnum::TRANSFER->value;
            }

            $actionData = MaterialRequestFactory::makeActionData(
                $requestedAt,
                $requestStatus,
                $machineUuid,
                $storageLocationUuid,
                $items,
                $type
            );

            (new CreateMaterialRequestAction())->handle($actionData);

            $minutes = rand(5, 20);

            $requestedAt->addMinutes($minutes);
        }
    }
}
