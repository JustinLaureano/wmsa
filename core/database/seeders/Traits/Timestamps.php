<?php

namespace Database\Seeders\Traits;

trait Timestamps
{
    protected string $cur_time;

    /**
     * Set the timestamp value.
     */
    protected function setCurrentTime() : void
    {
        $this->cur_time = now();
    }

    /**
     * Return the timestamps array for model records.
     */
    protected function getTimestamps() : array
    {
        return [
            'created_at' => $this->cur_time,
            'updated_at' => $this->cur_time
        ];
    }
}
