<?php

namespace App\Repositories;

use App\Models\Views\ViewSearchMachine;
use Illuminate\Support\Collection;

class ViewSearchMachineRepository
{
    public function search(string $query, int $limit = 10) : Collection
    {
        return ViewSearchMachine::search($query)
            ->take($limit)
            ->get()
            ->map(function($machine) {
                $machine->search_type = 'machine';
                return $machine;
            });
    }
}
