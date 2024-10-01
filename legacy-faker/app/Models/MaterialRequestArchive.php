<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaterialRequestArchive extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tblmaterialrequest_archive';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'srlnum';

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    public $timestamps = false;
}
