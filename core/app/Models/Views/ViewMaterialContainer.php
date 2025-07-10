<?php

namespace App\Models\Views;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ViewMaterialContainer extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     */
    protected $table = 'view_material_containers';

    /**
     * The primary key for the model.
     */
    protected $primaryKey = 'material_container_uuid';

    /**
     * The key type for the model.
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     */
    public $incrementing = false;

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
