<?php

namespace App\Jobs;

use App\Models\MaterialRequest;
use App\Models\SkidAlloted;
use App\Models\SkidItem;
use App\Models\SkidLocationHistory;
use App\Support\ClockNumber;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;

class AllotRequestSkids implements ShouldQueue
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
        MaterialRequest::whereNotClosed()
            ->doesntHave('skid')
            ->with('rackLocation')
            ->chunk(50, function (Collection $requests) {
                foreach ($requests as $request) {
                    $this->handleRequest($request);
                }
            });
    }

    private function handleRequest(MaterialRequest $request) : void
    {
        $item = SkidItem::query()
            ->where('item', $request->item)
            ->whereHas('location', function (Builder $query) {
                $query->whereNotIn('area', $this->getOmittedAreas());
            })
            ->doesntHave('request')
            ->first();

        if (!$item) return;

        DB::transaction(function () use ($item, $request) {
            SkidAlloted::query()->create([
                'skid_id' => $item->skid_id,
                'material_request_srlnum' => $request->srlnum
            ]);

            SkidLocationHistory::query()->create([
                'location_uid' => $request->rackLocation->uid,
                'location_srlnum' => $request->rackLocation->id,
                'skid_id' => $item->skid_id,
                'emp' => ClockNumber::getRandomMaterialHandler(),
                'time_stamp' => now(),
                'action' => 'ORDERED',
            ]);
        });
    }

    private function getOmittedAreas() : array
    {
        return [
            'COATERS',
            'COMPOUND STAGING',
            'IRM FLOOR',
            'MBDS OUT',
            'MRB',
            'MRB CAGE EXPANSION',
            'MRB FLOOR',
            'MRB STAGING',
            'MRB OVERFLOW',
            'MRB SORT',
            'Shipping Dock',
            'TOYOTA OUT',
            'Trailer 1',
            'Trailer 2',
            'Trailer 3'
        ];
    }
}
