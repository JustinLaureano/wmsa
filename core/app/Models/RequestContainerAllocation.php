<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class RequestContainerAllocation extends Model
{
    use HasFactory;

    public static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Str::uuid();
            $model->occurred_at = now();
        });
    }

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
        'material_request_item_uuid',
        'material_container_uuid',
        'occurred_at',
        'in_transit',
        'transit_user_uuid',
        'is_reserved',
    ];

    protected $casts = [
        'in_transit' => 'boolean',
        'is_reserved' => 'boolean',
    ];

    /**
     * Get the container for this allocation.
     */
    public function materialContainer(): BelongsTo
    {
        return $this->belongsTo(MaterialContainer::class, 'material_container_uuid', 'uuid');
    }

    /**
     * Get the request item for this allocation.
     */
    public function requestItem(): BelongsTo
    {
        return $this->belongsTo(MaterialRequestItem::class, 'material_request_item_uuid', 'uuid');
    }

    /**
     * Get the user who is transporting the container.
     */
    public function transitUser()
    {
        return $this->belongsTo(User::class, 'transit_user_uuid', 'uuid');
    }
}
