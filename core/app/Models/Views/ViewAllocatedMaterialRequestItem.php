<?php

namespace App\Models\Views;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ViewAllocatedMaterialRequestItem extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     */
    protected $table = 'view_allocated_material_request_items';

    /**
     * The primary key for the model.
     */
    protected $primaryKey = 'material_request_item_uuid';

    /**
     * The key type for the model.
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     */
    public $incrementing = false;
}
