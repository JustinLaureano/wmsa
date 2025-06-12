<?php

namespace App\Models\Views;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ViewStorageLocation extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'view_storage_locations';

    /**
     * The primary key for the model.
     */
    protected $primaryKey = 'storage_location_uuid';

    /**
     * Indicates if the IDs are auto-incrementing.
     */
    public $incrementing = false;
}
