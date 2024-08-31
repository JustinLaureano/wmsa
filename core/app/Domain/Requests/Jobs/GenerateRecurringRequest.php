<?php

namespace App\Domain\Requests\Jobs;

use App\Domain\Requests\Actions\CreateRequestAction;
use App\Domain\Requests\DataTransferObjects\RequestData;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GenerateRecurringRequest implements ShouldQueue
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
    public function handle(CreateRequestAction $action): void
    {
        $request = new RequestData(
            part_id: 1,
            location_id: 2
        );

        $action->handle($request);
    }
}
