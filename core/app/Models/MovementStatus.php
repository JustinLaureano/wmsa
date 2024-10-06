<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MovementStatus extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'movement_statuses';

    /**
     * Scope a query to filter on the part_number column.
     */
    public function scopeWhereCode(Builder $query, string $code): void
    {
        $query->where('code', $code);
    }
}
