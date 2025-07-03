<?php

namespace Database\Seeders;

use App\Domain\Locations\Enums\StorageLocationTypeEnum;
use App\Domain\Materials\DataTransferObjects\ContainerLocationData;
use App\Models\MaterialContainer;
use App\Models\StorageLocation;
use App\Models\StorageLocationType;
use App\Repositories\ContainerLocationRepository;
use App\Repositories\SortListRepository;
use Database\Seeders\Traits\Timestamps;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Lottery;

class ContainerLocationSeeder extends Seeder
{
    use Timestamps;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $repository = new ContainerLocationRepository;

        $containers = MaterialContainer::doesntHave('location')
            ->with('material')
            ->inRandomOrder()
            ->get();

        $sortParts = (new SortListRepository())->getPartNumbers()->toArray();

        foreach ($containers as $container) {
            $partNumber = $container->material->part_number;

            if ( in_array($partNumber, $sortParts) ) {
                $sortLocation = Lottery::odds(1, 2)->choose();

                if ($sortLocation) {
                    $location = StorageLocation::query()
                        ->whereIn('name', ['Plant 2 Sort', 'Blackhawk Sort'])
                        ->inRandomOrder()
                        ->first();
                }
                else {
                    $location = StorageLocation::query()
                        ->whereIn('name', ['Plant 2 Completion', 'Blackhawk Completion'])
                        ->inRandomOrder()
                        ->first();
                }
            }
            else {
                $palletRack = Lottery::odds(9, 10)->choose();

                if ($palletRack) {
                    $palletRackType = StorageLocationType::where('name', StorageLocationTypeEnum::PALLET_RACK->value)->first();

                    $location = StorageLocation::query()
                        ->doesntHave('containers')
                        ->whereHas('type', function (Builder $query) use ($palletRackType) {
                            $query->where('id', $palletRackType->id);
                        })
                        ->inRandomOrder()
                        ->first();
                }
                else {
                    $floorType = StorageLocationType::where('name', StorageLocationTypeEnum::FLOOR->value)->first();

                    $location = StorageLocation::query()
                        ->whereHas('type', function (Builder $query) use ($floorType) {
                            $query->where('id', $floorType->id);
                        })
                        ->inRandomOrder()
                        ->first();
                }
            }

            $data = new ContainerLocationData(
                material_container_uuid: $container->uuid,
                storage_location_uuid: $location->uuid
            );

            $repository->store($data);
        }
    }
}
