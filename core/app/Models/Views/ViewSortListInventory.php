<?php

namespace App\Models\Views;

use Illuminate\Database\Eloquent\Model;

class ViewSortListInventory extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'view_sort_list_inventory';

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
}
