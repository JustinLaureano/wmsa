<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RackLocation extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tblwms_rack_location';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'uid';

    public $timestamps = false;
}
