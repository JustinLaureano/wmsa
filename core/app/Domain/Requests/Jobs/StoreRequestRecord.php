<?php

namespace App\Domain\Requests\Jobs;

use App\Domain\Requests\Events\RequestCreated;
use App\Repositories\RequestRepository;
use App\Domain\Requests\DataTransferObjects\RequestData;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class StoreRequestRecord implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public RequestData $requestData)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(RequestRepository $repository): void
    {
        $request = $repository->create($this->requestData);

        RequestCreated::dispatch($request);
    }
}
