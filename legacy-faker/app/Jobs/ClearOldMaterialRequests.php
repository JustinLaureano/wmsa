<?php

namespace App\Jobs;

use App\Models\MaterialRequest;
use App\Models\MaterialRequestActivity;
use App\Models\MaterialRequestArchive;
use App\Models\MaterialRequestStatus;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ClearOldMaterialRequests implements ShouldQueue
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
        $statuses = [
            MaterialRequestStatus::CANCELED,
            MaterialRequestStatus::COMPLETED,
        ];

        MaterialRequest::query()
            ->whereIn('request_sts', $statuses)
            ->where('date', '<', now()->subDays(7)->toDateString())
            ->delete();

        MaterialRequestActivity::query()
            ->where('timestamp', '<', now()->subDays(7))
            ->delete();

        MaterialRequestArchive::query()
            ->whereIn('request_sts', $statuses)
            ->where('date', '<', now()->subDays(14))
            ->delete();
    }
}
