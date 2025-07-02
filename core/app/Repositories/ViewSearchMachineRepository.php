<?php

namespace App\Repositories;

use App\Models\Views\ViewSearchMachine;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class ViewSearchMachineRepository
{
    public function search(string $query, int $limit = 10) : Collection
    {
        return Cache::remember(
            'search_machine_' . $query,
            30,
            function () use ($query, $limit) {
                return ViewSearchMachine::search($query)
                ->take($limit)
                ->get()
                ->map(function($machine) {
                    $machine->key = $machine->machine_uuid;
                    $machine->primary_text = $machine->machine_name;
                    $machine->secondary_text = $machine->building_name;
                    $machine->search_type = 'machine';
                    $machine->url = route('machines.show', $machine->machine_uuid);
                    return $machine;
                });
        });
    }
}
