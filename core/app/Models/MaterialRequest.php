<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
        'requester_user_uuid',
        'requested_at'
    ];

    /**
     * Get the status for this request.
     */
    public function status(): HasOne
    {
        return $this->hasOne(MaterialRequestStatus::class, 'code', 'material_request_status_code');
    }

    /**
     * Get the requester for this request.
     */
    public function requester(): HasOne
    {
        return $this->hasOne(User::class, 'uuid', 'requester_user_uuid');
    }

    /**
     * Get the items for this request.
     */
    public function items(): HasMany
    {
        return $this->hasMany(MaterialRequestItem::class, 'uuid', 'material_request_uuid');
    }
}
