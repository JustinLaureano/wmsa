<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class MaterialRequest extends Model
{
    use HasFactory, SoftDeletes;

    public static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'material_request_status_code',
        'material_request_type_code',
        'requester_user_uuid',
        'requested_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'requested_at' => 'datetime',
    ];

    /**
     * Get the items for this request.
     */
    public function items(): HasMany
    {
        return $this->hasMany(MaterialRequestItem::class, 'material_request_uuid', 'uuid');
    }

    /**
     * Get the requester for this request.
     */
    public function requester(): HasOne
    {
        return $this->hasOne(User::class, 'uuid', 'requester_user_uuid');
    }
    
    /**
     * Get the status for this request.
     */
    public function status(): HasOne
    {
        return $this->hasOne(MaterialRequestStatus::class, 'code', 'material_request_status_code');
    }

    /**
     * Get the type for this request.
     */
    public function type()
    {
        return $this->hasOne(MaterialRequestType::class, 'code', 'material_request_type_code');
    }

    /**
     * Scope to get requests that have a select timestamp column
     * that is within the last 10 minutes.
     */
    public function scopeLastTenMinutes(Builder $query, string $timestampColumn)
    {
        return $query->where($timestampColumn, '>=', now()->subMinutes(10));
    }
}
