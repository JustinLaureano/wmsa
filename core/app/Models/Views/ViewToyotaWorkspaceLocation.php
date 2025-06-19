<?php

namespace App\Models\Views;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ViewToyotaWorkspaceLocation extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     */
    protected $table = 'view_toyota_workspace_locations';

    /**
     * The primary key for the model.
     */
    protected $primaryKey = 'toyota_workspace_location_uuid';

    /**
     * Indicates if the IDs are auto-incrementing.
     */
    public $incrementing = false;
}
