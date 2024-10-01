<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SkidItemArchive extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tblwms_skid_item_archive';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'uid';

    public $timestamps = false;
}
