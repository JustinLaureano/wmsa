<?php

namespace App\Repositories;

use App\Models\Views\ViewSearchMaterialRequest;
use Illuminate\Database\Eloquent\Collection;

class ViewSearchMaterialRequestRepository
{
    public function search(string $query, int $limit = 10) : Collection
    {
        return ViewSearchMaterialRequest::search($query)
            ->take($limit)
            ->get()
            ->map(function ($request) {
                $request->search_type = 'material_request';
                return $request;
            });
    }
}
