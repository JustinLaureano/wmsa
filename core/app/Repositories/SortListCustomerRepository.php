<?php

namespace App\Repositories;

use App\Models\SortListCustomer;
use Illuminate\Support\Collection;

class SortListCustomerRepository
{
    /**
     * Get all sort list customers.
     */
    public function get() : Collection
    {
        return SortListCustomer::query()
            ->orderBy('name', 'asc')
            ->get();
    }
}