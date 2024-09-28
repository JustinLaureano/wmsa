<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaterialRequestStatus extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tblmaterialrequeststatus';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'sts_code';

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    public $timestamps = false;

    public const OPEN = 0;
    public const PENDING = 1;
    public const SHIPPED = 2;
    public const PARTIAL = 3;
    public const OUT_OF_STOCK = 4;
    public const NOT_HERE = 5;
    public const STAGED = 6;
    public const SENT_TO_REPACK = 7;
    public const DELIVERY_IN_PROGRESS = 8;
    public const REPACK_COMPLETE = 97;
    public const COMPLETED = 98;
    public const CANCELED = 99;
}
