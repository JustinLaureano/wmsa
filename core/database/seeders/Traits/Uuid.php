<?php

namespace Database\Seeders\Traits;

use Illuminate\Support\Str;

trait Uuid
{
    /**
     * Return a uuid array for model records.
     */
    protected function getUuid() : array
    {
        return [ 'uuid' => Str::uuid() ];
    }
}
