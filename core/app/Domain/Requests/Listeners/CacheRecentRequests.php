<?php

namespace App\Domain\Requests\Listeners;

use App\Models\Request;
use App\Domain\Requests\Events\RequestCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Cache;

class CacheRecentRequests implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(RequestCreated $event): void
    {
        Cache::put(
            'recent_requests',
            Request::latest()->paginate(),
            now()->addMinutes(5)
        );
    }
}
