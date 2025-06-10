<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContainerEvent extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'material_container_uuid',
        'event_type',
        'event_data',
        'summary',
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

    /**
     * Get the container for this event.
     */
    public function container(): BelongsTo
    {
        return $this->belongsTo(MaterialContainer::class, 'material_container_uuid', 'uuid');
    }
}
