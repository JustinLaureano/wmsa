<?php

namespace App\Repositories;

use App\Models\RequestContainerAllocation;
use App\Domain\Production\DataTransferObjects\RequestContainerAllocationData;

class RequestContainerAllocationRepository
{
    public function store(RequestContainerAllocationData $data) : RequestContainerAllocation
    {
        return RequestContainerAllocation::create($data->toArray());
    }
}