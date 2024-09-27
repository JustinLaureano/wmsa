<?php

namespace App\Jobs;

use App\Models\RackLocation;
use App\Models\RackLocationAlloted;
use App\Models\SkidItem;
use App\Models\SkidLocation;
use App\Models\SkidLocationHistory;
use App\Repositories\RackLocationRepository;
use App\Support\BuildingArea;
use App\Support\ClockNumber;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Lottery;

class PutSkidsAway implements ShouldQueue
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
        // TODO steps
        $this->putAwayAllotedSkids();

        // get skids without locations for more than 10 minutes
        $this->allotNewSkids();

        // move old receiving dock skids to location
        $this->allotReceivingDockSkids();

    }

    private function putAwayAllotedSkids() : void
    {
        SkidItem::has('alloted')
            ->with('alloted.location')
            ->chunk(100, function (Collection $items) {
                foreach ($items as $item) {
                    $this->handleAllotedSkid($item);
                }
            });
    }

    private function handleAllotedSkid(SkidItem $item) : void
    {
        $putAway = Lottery::odds(1, 3)->choose();

        if (!$putAway) return;

        $location = $item->alloted->location;

        DB::transaction(function () use ($item, $location) {
            SkidLocation::where('skid_id', $item->skid_id)->delete();

            SkidLocation::query()->create(
                [
                    'skid_id' => $item->skid_id,
                    'location_uid' => $location->uid,
                    'location_srlnum' => $location->id,
                    'emp' => ClockNumber::getRandomMaterialHandler()
                ]
            );

            RackLocationAlloted::where('skid_id', $item->skid_id)->delete();
        });
    }

    private function allotNewSkids() : void
    {
        $waitTime = now()->subMinutes(10);

        SkidItem::doesntHave('location')
            ->where('time', '<', $waitTime)
            ->with([
                'buildingOneArea',
                'buildingTwoArea',
                'buildingThreeArea'
            ])
            ->orderBy('time', 'ASC')
            ->chunk(100, function (Collection $items) {
                foreach ($items as $item) {
                    $this->handleNewSkid($item);
                }
            });
    }

    private function handleNewSkid(SkidItem $item) : void
    {
        $allot = Lottery::odds(1, 8)->choose();

        if (!$allot) return;

        if ($this->itemNeedsReceived($item)) {
            $this->allot(
                $item,
                (new RackLocationRepository)->getReceivingDock()
            );
        }

        $buildingArea = BuildingArea::getRandomForSkidItem($item);

        $location = (new RackLocationRepository)->findEmptyByArea($buildingArea->area, $buildingArea->building);

        if (!$location) return;

        $this->allot($item, $location);
    }

    private function itemNeedsReceived(SkidItem $item) : bool
    {
        $areas = ['ALUMINUM', 'RAW', 'PHOSPHATE'];

        return  $item->buildingOneArea &&
                in_array($item->buildingOneArea->location, $areas);
    }

    private function allot(SkidItem $item, RackLocation $location) : void
    {
        DB::transaction(function () use ($item, $location) {
            $time = $item->history->count()
                ? now()
                : (new Carbon($item->time))->addMinutes(rand(1, 5));

            RackLocationAlloted::query()->updateOrCreate([
                'location_srlnum' => $location->id,
                'skid_id' => $item->skid_id
            ]);

            SkidLocationHistory::query()->create([
                'location_uid' => $location->uid,
                'location_srlnum' => $location->id,
                'skid_id' => $item->skid_id,
                'emp' => ClockNumber::getRandomMaterialHandler(),
                'time_stamp' => $time,
                'action' => 'ALLOCATED',
            ]);
        });
    }

    private function allotReceivingDockSkids() : void
    {
        SkidItem::query()
            ->whereHas('location', function (Builder $query) {
                $query->where('location_srlnum', 'RECEIVING DOCK');
            })
            ->doesntHave('alloted')
            ->with([
                'buildingOneArea',
                'buildingTwoArea',
                'buildingThreeArea'
            ])
            ->chunk(100, function (Collection $items) {
                foreach ($items as $item) {
                    $this->handleReceivingDockSkid($item);
                }
            });
    }

    /**
     * Find and allot the next location for the skid item.
     * 
     * 1. Look for building one area
     * 2. If no suitable building one areas, Look for building two areas
     * 3. If no suitable building two areas but can be stored there, send to expansion out so that 
     *    it can be transferred to building two floor area
     * 4. If no suitable building two areas, Look for building three areas
     * 5. Choose random floor location in building one
     */
    private function handleReceivingDockSkid(SkidItem $item) : void
    {
        $allot = Lottery::odds(1, 8)->choose();

        if (!$allot) return;

        $location = null;

        if ( $item->buildingOneArea ) {
            $location = (new RackLocationRepository)
                ->findEmptyByArea($item->buildingOneArea->location, building: 1);
        }

        if ( !$location && $item->buildingTwoArea ) {
            $location = (new RackLocationRepository)
                ->findEmptyByArea($item->buildingTwoArea->location, building: 2);

            if (!$location) {
                $location = (new RackLocationRepository)->findById('EXPANSION 1');
            }
        }

        if ( !$location && $item->buildingThreeArea ) {
            $location = (new RackLocationRepository)
                ->findEmptyByArea($item->buildingThreeArea->location, building: 3);
        }

        if (!$location) {
            $floorLocations = ['WIP FLOOR', 'PWIP FLOOR'];
            $location = (new RackLocationRepository)
                ->findById($floorLocations[array_rand($floorLocations)]);
        }

        $this->allot($item, $location);
    }
}
