<?php

namespace App\Domain\Materials\Jobs;

use App\Domain\Materials\DataTransferObjects\ContainerMovementData;
use App\Domain\Materials\Events\ContainerMovementFinished;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class PerformContainerMovement implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public ContainerMovementData $data)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // TODO: move container and log event

        ContainerMovementFinished::dispatch();
    }
}
