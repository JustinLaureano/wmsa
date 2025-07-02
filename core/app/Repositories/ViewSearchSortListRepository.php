<?php

namespace App\Repositories;

use App\Models\Views\ViewSearchSortList;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class ViewSearchSortListRepository
{
    public function search(string $query, int $limit = 10) : Collection
    {
        return Cache::remember(
            'search_sort_list_' . $query,
            30,
            function () use ($query, $limit) {
                return ViewSearchSortList::search($query)
                    ->take($limit)
                    ->get()
                    ->map(function ($sortList) {
                        $sortList->key = $sortList->sort_list_uuid;
                        $sortList->primary_text = $sortList->part_number;
                        $sortList->secondary_text = $sortList->material_description;
                        $sortList->search_type = 'sort_list';
                        $sortList->url = route('quality.sort.show', $sortList->sort_list_uuid);
                        return $sortList;
                    });
        });
    }
}
