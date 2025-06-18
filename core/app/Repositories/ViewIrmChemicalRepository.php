<?php

namespace App\Repositories;

use App\Models\Views\ViewIrmChemical;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

class ViewIrmChemicalRepository
{
    public function filterPaginate($search = null) : LengthAwarePaginator
    {
        if ($search === null) {
            $search = request()->query('search');
        }

        return ViewIrmChemical::search($search)
            ->query(fn (Builder $query) => $query->filter())
            ->orderBy('part_number', 'asc')
            ->paginate();
    }
}
