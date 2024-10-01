<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SkidLocationHistoryArchive extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tblwms_skid_location_history_archive';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'uid';

    public $timestamps = false;
}
