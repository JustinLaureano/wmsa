<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    /**
     * TODO: remove
     */


    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name'
    ];

    /**
     * Get the parts in this location.
     */
    public function parts(): HasMany
    {
        return $this->hasMany(Part::class);
    }

    /**
     * Get the request for the location.
     */
    public function request(): BelongsTo
    {
        return $this->belongsTo(Request::class);
    }
}
