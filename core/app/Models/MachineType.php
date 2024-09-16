<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class MachineType extends Model
{
    use SoftDeletes;

    /**
     * Get the machines for the machine type.
     */
    public function machines(): HasMany
    {
        return $this->hasMany(Machine::class);
    }
}
