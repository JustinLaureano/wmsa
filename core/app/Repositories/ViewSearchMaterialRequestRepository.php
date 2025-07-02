<?php

namespace App\Repositories;

use App\Models\Views\ViewSearchMaterialRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class ViewSearchMaterialRequestRepository
{
    public function search(string $query, int $limit = 10) : Collection
    {
        return Cache::remember(
            'search_material_request_' . $query,
            30,
            function () use ($query, $limit) {
                return ViewSearchMaterialRequest::search($query)
                    ->take($limit)
                    ->get()
                    ->map(function ($request) {
                        $request->key = $request->material_request_uuid;
                        $request->primary_text = $request->part_number .' to '.
                            ($request->machine_name
                                ? $request->machine_name
                                : $request->storage_location_name);
                        $request->secondary_text = $request->material_request_status_code;
                        $request->search_type = 'material_request';
                        $request->url = route('production.material-request.show', $request->material_request_uuid);
                        return $request;
                    });
        });
    }
}
