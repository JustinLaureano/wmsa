<?php

namespace App\Models\Views;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ViewMaterialRouting extends Model
{
    use SoftDeletes;

    /**
     * The primary key for the model.
     */
    protected $primaryKey = 'material_routing_uuid';

    /**
     * The table associated with the model.
     */
    protected $table = 'view_material_routing';

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
