<?php

namespace App\Repositories;

use App\Models\RequestItemStatus;
use Illuminate\Database\Eloquent\Collection;

class RequestItemStatusRepository
{
    public function get(): Collection
    {
        return RequestItemStatus::query()->get();
    }
}
