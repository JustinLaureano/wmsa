<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaterialType extends Model
{
    use SoftDeletes;

    /**
     * Get the materials for the material type.
     */
    public function materials(): HasMany
    {
        return $this->hasMany(Material::class);
    }
}
