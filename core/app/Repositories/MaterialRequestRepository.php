<?php

namespace App\Repositories;

use App\Domain\Production\DataTransferObjects\MaterialRequestData;
use App\Models\MaterialRequest;

class MaterialRequestRepository
{
    /**
     * Store a material request record.
     */
    public function store(MaterialRequestData $data) : MaterialRequest
    {
        return MaterialRequest::create($data->toArray());
    }
}
