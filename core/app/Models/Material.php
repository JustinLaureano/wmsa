<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Material extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'material_number',
        'part_number',
        'description',
        'base_qty',
        'base_unit_of_measure',
        'material_type_id'
    ];

    /**
     * Get the material type for the material.
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(MaterialType::class, 'material_type_id', 'id');
    }
}