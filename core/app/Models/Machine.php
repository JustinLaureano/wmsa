<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Machine extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'name',
        'building_id',
        'machine_type_id'
    ];

    /**
     * Get the machine type for the machine.
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(MachineType::class, 'machine_type_id', 'id');
    }
}
