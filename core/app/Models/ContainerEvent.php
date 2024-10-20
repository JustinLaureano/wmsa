<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContainerEvent extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'material_container_uuid',
        'event_type',
        'event_data',
        'occurred_at',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'event_data' => 'object',
        ];
    }
}
