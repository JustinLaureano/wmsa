<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class MaterialRequest extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tblmaterialrequest';

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

    /**
     * Get the skid item for the material request.
     */
    public function skid(): HasOneThrough
    {
        return $this->hasOneThrough(
            SkidItem::class,
            SkidAlloted::class,
            'material_request_srlnum', // tblwms_skid_alloted.material_request_srlnum
            'skid_id', // tblwms_skid_item.skid_id
            'srlnum', // tblmaterialrequest.srlnum
            'skid_id', // tblwms_skid_alloted.skid_id
        );
    }

    /**
     * Scope a query to only include popular users.
     */
    public function scopeNewest(Builder $query): void
    {
        $query->orderBy('date', 'DESC')->orderBy('time', 'DESC');
    }

    /**
     * Scope a query to filter for non closed requests.
     */
    public function scopeWhereNotClosed(Builder $query): void
    {
        $query->whereIn('request_sts', [
            MaterialRequestStatus::OPEN,
            MaterialRequestStatus::PENDING,
            MaterialRequestStatus::PARTIAL,
            MaterialRequestStatus::STAGED,
        ]);
    }

    /**
     * The created at timestamp.
     */
    protected function createdAt(): Attribute
    {
        return new Attribute(
            get: fn () => $this->date .' '. $this->time,
        );
    }
}
