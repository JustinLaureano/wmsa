<?php

namespace Database\Seeders;

use App\Domain\Materials\DataTransferObjects\ContainerLocationData;
use App\Models\MaterialContainer;
use App\Models\StorageLocation;
use App\Repositories\ContainerLocationRepository;
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

        $containers = MaterialContainer::doesntHave('location')->inRandomOrder()->get();

        foreach ($containers as $container) {
            $noLocation = Lottery::odds(1, 100)->choose();

            if ($noLocation) continue;

            $palletRack = Lottery::odds(9, 10)->choose();
            // $palletRack = Lottery::odds(10, 10)->choose();

            if ($palletRack) {
                $location = StorageLocation::query()
                    ->doesntHave('containers')
                    ->whereHas('type', function (Builder $query) {
                        $query->where('id', 1);
                    })
                    ->inRandomOrder()
                    ->first();
            }
            else {
                $location = StorageLocation::query()
                    ->whereHas('type', function (Builder $query) {
                        $query->where('id', 9);
                    })
                    ->inRandomOrder()
                    ->first();
            }

            $data = new ContainerLocationData(
                material_container_uuid: $container->uuid,
                storage_location_uuid: $location->uuid
            );

            $repository->store($data);
        }
    }
}
