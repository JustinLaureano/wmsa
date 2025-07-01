<?php

namespace App\Repositories;

use App\Models\Views\ViewMachine;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

class ViewMachineRepository
{
    public function filterPaginate($search = null) : LengthAwarePaginator
    {
        if ($search === null) {
            $search = request()->query('search');
        }

        return ViewMachine::search($search)
            ->query(fn (Builder $query) => $query->filter())
            ->orderBy('machine_name', 'asc')
            ->paginate();
    }
}
