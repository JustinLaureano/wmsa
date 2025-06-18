<?php

namespace App\Models\Views;

use Illuminate\Database\Eloquent\Model;

class ViewIrmChemicalInventory extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'view_irm_chemical_inventory';

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
