<?php

namespace App\Jobs;

use App\Models\RackLocation;
use App\Models\RackLocationAlloted;
use App\Models\SkidItem;
use App\Repositories\RackLocationRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
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

        // get skids without locations for more than 10 minutes
        $this->putAwayNewSkids();

        // get all receiving dock skids older than 8 minutes
        // move old receiving dock skids to location
        $this->putAwayReceivingDockSkids();


        // $this->putAwayAllotedSkids();
    }

    private function putAwayNewSkids() : void
    {
        $waitTime = now()->subMinutes(10);

        SkidItem::doesntHave('location')
            ->where('time', '<', $waitTime)
            ->with([
                'buildingOneArea',
                'buildingTwoArea',
                'buildingThreeArea'
            ])
            ->chunk(100, function (Collection $items) {
                foreach ($items as $item) {
                    $this->handleNewSkid($item);
                }
            });
    }

    private function handleNewSkid(SkidItem $item) : void
    {
        $putAway = Lottery::odds(1, 8)->choose();

        if (!$putAway) return;

        if ($this->itemNeedsReceived($item)) {
            // allot to the receiving dock
            $this->allot(
                $item,
                (new RackLocationRepository)->getReceivingDock()
            );
        }

        // if building location, allocate for that location

        // if no location, put on floor


    }

    private function itemNeedsReceived(SkidItem $item) : bool
    {
        $areas = ['ALUMINUM', 'RAW', 'PHOSPHATE'];

        return  $item->buildingOneArea &&
                in_array($item->buildingOneArea->location, $areas);
    }

    private function allot(SkidItem $item, RackLocation $location) : void
    {
        RackLocationAlloted::query()->updateOrCreate([
            'location_srlnum' => $location->id,
            'skid_id' => $item->skid_id
        ]);
    }

    private function putAwayReceivingDockSkids() : void
    {
        SkidItem::query()
            ->whereHas('location', function (Builder $query) {
                $query->where('location_srlnum', 'RECEIVING DOCK');
            })
            ->with([
                'buildingOneArea',
                'buildingTwoArea',
                'buildingThreeArea'
            ])
            ->chunk(100, function (Collection $items) {
                foreach ($items as $item) {
                    Log::debug($item->skid_id);
                    // $this->handleReceivingDockSkid($item);
                }
            });
    }
}
