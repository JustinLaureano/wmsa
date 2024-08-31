<?php

namespace App\Repositories;

use App\Models\Request;
use App\Domain\Requests\DataTransferObjects\RequestData;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class RequestRepository
{
    public function create(RequestData $data) : Request
    {
        return Request::create($data->toArray());
    }

    public function getLatestPaginated(int $perPage = 15) : LengthAwarePaginator
    {
        return Request::query()->latest()->paginate($perPage);
    }

    public function getRecentRequests(int $perPage = 15) : LengthAwarePaginator
    {
        return Cache::get('recent_requests', function () use ($perPage) {
            return $this->getLatestPaginated($perPage);
        });
    }
}