<?php

namespace App\Repositories;

use App\Models\Views\ViewSearchSortList;
use Illuminate\Database\Eloquent\Collection;

class ViewSearchSortListRepository
{
    public function search(string $query, int $limit = 10) : Collection
    {
        return ViewSearchSortList::search($query)
            ->take($limit)
            ->get()
            ->map(function ($sortList) {
                $sortList->search_type = 'sort_list';
                return $sortList;
            });
    }
}
