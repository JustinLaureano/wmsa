<?php

namespace App\Domain\Production\Jobs\Scheduled;

use App\Domain\Production\Enums\RequestStatusEnum;
use App\Domain\Production\Jobs\AttemptRequestContainerAllocation;
use App\Models\MaterialRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class AttemptRequestListAllocations implements ShouldQueue
{
    use Queueable;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        MaterialRequest::query()
            ->where('material_request_status_code', RequestStatusEnum::OPEN->value)
            ->doesntHave('containerAllocation')
            ->get()
            ->each(function (MaterialRequest $request) {
                AttemptRequestContainerAllocation::dispatch($request);
            });
    }
}
