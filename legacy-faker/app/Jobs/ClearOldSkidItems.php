<?php

namespace App\Jobs;

use App\Models\RackLocationAlloted;
use App\Models\SkidAlloted;
use App\Models\SkidAllotedHistory;
use App\Models\SkidItem;
use App\Models\SkidItemArchive;
use App\Models\SkidLocation;
use App\Models\SkidLocationHistory;
use App\Models\SkidLocationHistoryArchive;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ClearOldSkidItems implements ShouldQueue
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
     * 
     * The main purpose of this job is to keep the database size
     * manageable by pruning all old and unnecessary data once
     * it has been through the fake production pipeline.
     */
    public function handle(): void
    {
        $skidIds = SkidLocationHistory::query()
            ->select('skid_id')
            ->where([
                ['action', 'DELIVERED'],
                ['time_stamp', '<', now()->subDays(30)]
            ])
            ->pluck('skid_id')
            ->toArray();

        RackLocationAlloted::query()->whereIn('skid_id', $skidIds)->delete();
        SkidAllotedHistory::query()->whereIn('skid_id', $skidIds)->delete();
        SkidAlloted::query()->whereIn('skid_id', $skidIds)->delete();
        SkidLocationHistoryArchive::query()->whereIn('skid_id', $skidIds)->delete();
        SkidLocationHistory::query()->whereIn('skid_id', $skidIds)->delete();
        SkidLocation::query()->whereIn('skid_id', $skidIds)->delete();

        // TODO: add missing tables
        // tblwms_skid_degassed
        // tblwms_skid_storage_reason

        SkidItemArchive::whereIn('skid_id', $skidIds)->delete();
        SkidItem::whereIn('skid_id', $skidIds)->delete();
    }
}
