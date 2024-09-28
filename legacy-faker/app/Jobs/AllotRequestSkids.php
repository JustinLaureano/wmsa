<?php

namespace App\Jobs;

use App\Models\MaterialRequest;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Queue\Queueable;

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
            ->chunk(100, function (Collection $requests) {
                foreach ($requests as $request) {
                    // $this->handleRequest($request);
                }
            });
    }

    private function handleRequest() : void
    {
        // TODO: find a skid to allot
        // make allotment
    }
}
