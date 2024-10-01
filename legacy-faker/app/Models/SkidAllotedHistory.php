<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SkidAllotedHistory extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tblwms_skid_alloted_history';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'material_request_srlnum';

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    public $timestamps = false;
}
