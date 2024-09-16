<?php

namespace Database\Seeders\Traits;

trait Timestamps
{
    /**
     * Return the timestamps array for model records.
     */
    protected function getTimestamps() : array
    {
        $now = now();

        return [
            'created_at' => $now,
            'updated_at' => $now
        ];
    }
}
