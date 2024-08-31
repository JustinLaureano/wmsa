<?php

namespace App\Domain\Requests\Actions;

use App\Domain\Requests\DataTransferObjects\RequestData;
use App\Domain\Requests\Jobs\StoreRequestRecord;
use App\Domain\Requests\Jobs\UpsertRecentRequestsCache;

class CreateRequestAction
{
    public function handle(RequestData $requestData)
    {
        StoreRequestRecord::dispatch($requestData);

        UpsertRecentRequestsCache::dispatch();

        RequestCreated::dispatch($request);
    }
}