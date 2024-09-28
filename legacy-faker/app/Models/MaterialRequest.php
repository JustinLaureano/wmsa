<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    public $timestamps = false;

    /**
     * Get the skid item for the material request.
     */
    public function skid(): HasOne
    {
        return $this->hasOne(
            SkidItem::class,
            'skid_id',
            'skid_id'
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
     * The created at timestamp.
     */
    protected function createdAt(): Attribute
    {
        return new Attribute(
            get: fn () => $this->date .' '. $this->time,
        );
    }
}
