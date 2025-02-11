<?php

namespace App\Domain\Production\Jobs\Scheduled;

use App\Domain\Production\Enums\RequestStatusEnum;
use App\Domain\Production\Jobs\AttemptRequestContainerAllocation;
use App\Models\MaterialRequest;
use App\Models\MaterialRequestItem;
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
        // TODO: reimplement this job with new container allocation logic
        logger()->info('Hi, Attempting to allocate containers for open requests');
        MaterialRequest::query()
            ->where('material_request_status_code', RequestStatusEnum::OPEN->value)
            ->with('items')
            ->whereHas('items', function ($query) {
                $query->doesntHave('containerAllocation');
            })
            ->get()
            ->each(function (MaterialRequest $request) {
                $request->items->each(function (MaterialRequestItem $item) {
                    AttemptRequestContainerAllocation::dispatch($item);
                });
            });
    }
}
