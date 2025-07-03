<?php

namespace Database\Seeders;

use App\Models\BuildingTransferArea;
use App\Models\StorageLocationArea;
use Database\Seeders\Traits\Timestamps;
use Database\Seeders\Traits\Uuid;
use Illuminate\Database\Seeder;

class BuildingTransferAreaSeeder extends Seeder
{
    use Timestamps, Uuid;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plant2In = StorageLocationArea::where('name', 'PLANT 2 IN')->first();
        $plant2Out = StorageLocationArea::where('name', 'PLANT 2 OUT')->first();
        $blackhawkIn = StorageLocationArea::where('name', 'BLACKHAWK IN')->first();
        $blackhawkOut = StorageLocationArea::where('name', 'BLACKHAWK OUT')->first();
        $defianceIn = StorageLocationArea::where('name', 'DEFIANCE IN')->first();
        $defianceOut = StorageLocationArea::where('name', 'DEFIANCE OUT')->first();

        $data = [
            array_merge(
                [
                    'building_id' => 1,
                    'inbound_storage_location_area_id' => $plant2In->id,
                    'outbound_storage_location_area_id' => $plant2Out->id,
                ],
                $this->getUuid(),
                $this->getTimestamps()
            ),
            array_merge(
                [
                    'building_id' => 2,
                    'inbound_storage_location_area_id' => $blackhawkIn->id,
                    'outbound_storage_location_area_id' => $blackhawkOut->id,
                ],
            $this->getUuid(),
            $this->getTimestamps()
            ),
            array_merge(
                    [
                    'building_id' => 3,
                    'inbound_storage_location_area_id' => $defianceIn->id,
                    'outbound_storage_location_area_id' => $defianceOut->id,
                ],
                $this->getUuid(),
                $this->getTimestamps()
            ),
        ];

        BuildingTransferArea::insert($data);
    }
}
