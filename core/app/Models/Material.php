<?php

namespace App\Models;

use App\Support\Eloquent\Filter\Filterable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Material extends Model
{
    use Filterable,
        HasFactory,
        Searchable,
        SoftDeletes;

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
        'material_type_code',
        'base_quantity',
        'base_unit_of_measure',
    ];

    /**
     * The attributes that are filterable.
     */
    protected array $filterable = [
        'uuid',
        'material_number',
        'part_number',
        'description',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<string>
     */
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * Get the indexable data array for the model.
     *
     * @return array<string, mixed>
     */
    public function toSearchableArray(): array
    {
        return [
            'material_number' => $this->material_number,
            'part_number' => $this->part_number,
            'description' => $this->description,
        ];
    }

    /**
     * Get the container inventories for the material.
     */
    public function containers(): HasMany
    {
        return $this->hasMany(MaterialContainer::class, 'material_uuid', 'uuid');
    }

    /**
     * Get the material type for the material.
     */
    public function materialType(): HasOne
    {
        return $this->hasOne(MaterialType::class, 'code', 'material_type_code');
    }

    /**
     * Scope a query to filter on the part_number column.
     */
    public function scopeWherePartNumber(Builder $query, string $partNumber): void
    {
        $query->where('part_number', $partNumber);
    }

    /**
     * Scope a query to filter on the uuid column.
     */
    public function scopeWhereUuid(Builder $query, string $uuid): void
    {
        $query->where('uuid', $uuid);
    }
}
