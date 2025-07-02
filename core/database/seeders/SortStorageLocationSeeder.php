<?php

namespace Database\Seeders;

use App\Models\SortStorageLocation;
use App\Models\StorageLocation;
use Database\Seeders\Traits\Timestamps;
use Database\Seeders\Traits\Uuid;
use Illuminate\Database\Seeder;

class SortStorageLocationSeeder extends Seeder
{
    use Timestamps, Uuid;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plant2Sort = StorageLocation::where('name', 'Plant 2 Sort')->first();
        $blackhawkSort = StorageLocation::where('name', 'Blackhawk Sort')->first();

        SortStorageLocation::create(array_merge(
            [
                'building_id' => 1,
                'storage_location_area_id' => $plant2Sort->storage_location_area_id,
            ],
            $this->getUuid(),
            $this->getTimestamps()
        ));

        SortStorageLocation::create(array_merge(
            [
                'building_id' => 2,
                'storage_location_area_id' => $blackhawkSort->storage_location_area_id,
            ],
            $this->getUuid(),
            $this->getTimestamps()
        ));
    }
}
