<?php

namespace App\Jobs;

use App\Models\MaterialRequest;
use App\Models\MaterialRequestActivity;
use App\Models\MaterialRequestStatus;
use App\Models\RackLocation;
use App\Models\RackLocationAlloted;
use App\Models\SkidAlloted;
use App\Models\SkidItem;
use App\Models\SkidLocation;
use App\Models\SkidLocationHistory;
use App\Repositories\RackLocationRepository;
use App\Support\ClockNumber;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Lottery;

class DeliverRequestedSkids implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // TODO for action

        /**
         * Start by iterating all alloted skids and determine
         * the appropriate steps for delivery for each skid.
         */
        SkidAlloted::query()
            ->with(['item.location', 'request.rackLocation'])
            ->chunk(50, function (Collection $alloted) {
                foreach ($alloted as $skid) {
                    $this->handleSkidMovement($skid);
                }
            });
    }

    /**
     * Here each skid will be appropriately moved according to the 
     * needs of the request and respect to its current location.
     *
     * If the skid is already located inside the building that the
     * requested location is also at, then it can be delivered to
     * the requested location.
     * 
     * In building one, some skids will go to a staging floor location
     * before the get delivered to the final location. Randomness
     * has been created to send some skids to staging first.
     * 
     * If the skid is not in the current delivery location building,
     * then the skid will be routed first to its current buildings
     * out location, and then to the delivery building's in location.
     * From there it follows the steps listed above when the skid
     * is located in the same building as the delivery location.
     */
    private function handleSkidMovement(SkidAlloted $skid) : void
    {
        $move = Lottery::odds(1, 5)->choose();

        if (!$move) return;

        $clockNumber = ClockNumber::getRandomMaterialHandler();

        if ( $this->skidIsInDeliveryBuilding($skid) ) {

            if ($this->skidIsInStaging($skid)) {
                $this->deliverSkid($skid, $clockNumber);
            }
            else if ($this->skidIsInBuildingOne($skid)) {
                $stage = Lottery::odds(1, 8)->choose();

                if ($stage) {
                    $this->moveSkid($skid->item, $this->getStagingLocation(), $clockNumber);
                    $this->updateRequest($skid->request, MaterialRequestStatus::STAGED, $clockNumber);
                }
                else {
                    $this->deliverSkid($skid, $clockNumber);
                }
            }
            else {
                $this->deliverSkid($skid, $clockNumber);
            }

        }
        else {
            $skidBuilding = $skid->item->location->building;

            $location = $this->skidIsInBuildingOutLocation($skidBuilding, $skid->item->location)
                ? $this->getBuildingInLocation($skid->request->rackLocation->building)
                : $this->getBuildingOutLocation($skidBuilding);

            if ( !$location ) return;

            $this->allotSkid($skid->item, $location, $clockNumber);
        }
    }

    private function deliverSkid(SkidAlloted $skid, string $clockNumber) : void
    {
        DB::transaction(function () use ($skid, $clockNumber) {
            $item = $skid->item;
            $request = $skid->request;
            $location = $skid->request->rackLocation;

            SkidLocation::where('skid_id', $item->skid_id)->delete();

            SkidLocationHistory::query()->create([
                'location_uid' => $location->uid,
                'location_srlnum' => $location->id,
                'skid_id' => $item->skid_id,
                'emp' => $clockNumber,
                'time_stamp' => now(),
                'action' => 'DELIVERED',
            ]);

            RackLocationAlloted::where('skid_id', $item->skid_id)->delete();

            $this->updateRequest($request, MaterialRequestStatus::COMPLETED, $clockNumber);

            $skid->delete();
        });
    }

    private function allotSkid(SkidItem $item, RackLocation $location, string $clockNumber) : void
    {
        DB::transaction(function () use ($item, $location, $clockNumber) {
            RackLocationAlloted::query()->updateOrCreate([
                'location_srlnum' => $location->id,
                'skid_id' => $item->skid_id
            ]);

            SkidLocationHistory::query()->create([
                'location_uid' => $location->uid,
                'location_srlnum' => $location->id,
                'skid_id' => $item->skid_id,
                'emp' => $clockNumber,
                'time_stamp' => now(),
                'action' => 'ALLOCATED',
            ]);
        });
    }

    private function moveSkid(SkidItem $item, RackLocation $location, string $clockNumber) : void
    {
        DB::transaction(function () use ($item, $location, $clockNumber) {
            SkidLocation::where('skid_id', $item->skid_id)->delete();

            SkidLocation::query()->create([
                'skid_id' => $item->skid_id,
                'location_uid' => $location->uid,
                'location_srlnum' => $location->id,
                'emp' => $clockNumber
            ]);

            RackLocationAlloted::where('skid_id', $item->skid_id)->delete();
        });
    }

    private function updateRequest(MaterialRequest $request, int $requestStatus, string $clockNumber) : void
    {
        DB::transaction(function () use ($request, $requestStatus, $clockNumber) {
            $request->request_sts = $requestStatus;
            $request->save();

            MaterialRequestActivity::query()->create([
                'request_srlnum' => $request->srlnum,
                'emp' => $clockNumber,
                'device' => fake()->ipv4(),
                'request_sts' => $requestStatus,
                'notes' => $request->notes
            ]);
        });
    }

    private function skidIsInDeliveryBuilding(SkidAlloted $skid) : bool
    {
        return $skid->item->location->building === $skid->request->rackLocation->building;
    }

    private function skidIsInBuildingOne(SkidAlloted $skid) : bool
    {
        return $skid->item->location->building === 1;
    }

    private function skidIsInBuildingTwo(SkidAlloted $skid) : bool
    {
        return $skid->item->location->building === 2;
    }

    private function skidIsInBuildingThree(SkidAlloted $skid) : bool
    {
        return $skid->item->location->building === 3;
    }

    private function skidIsInBuildingOutLocation(int $building, RackLocation $skidLocation) : bool
    {
        $outId = match($building) {
            1 => config('domain.building_one_out_id'),
            2 => config('domain.building_two_out_id'),
            3 => config('domain.building_three_out_id'),
            default => ''
        };

        return $skidLocation->id == $outId;
    }

    private function getBuildingInLocation(int $building) : RackLocation
    {
        $outId = match($building) {
            1 => config('domain.building_one_in_id'),
            2 => config('domain.building_two_in_id'),
            3 => config('domain.building_three_in_id'),
            default => config('domain.building_one_in_id')
        };

        return (new RackLocationRepository)->findById($outId);
    }

    private function getBuildingOutLocation(int $building) : RackLocation
    {
        $outId = match($building) {
            1 => config('domain.building_one_out_id'),
            2 => config('domain.building_two_out_id'),
            3 => config('domain.building_three_out_id'),
            default => config('domain.building_one_out_id')
        };

        return (new RackLocationRepository)->findById($outId);
    }

    private function skidIsInStaging(SkidAlloted $skid) : bool
    {
        return str_contains($skid->item->location->area, 'STAGE');
    }

    private function getStagingLocation() : RackLocation
    {
        return RackLocation::where('area', 'STAGE - IN')->first();
    }
}
