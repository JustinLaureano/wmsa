<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teammate extends Model implements AuthenticatableContract
{
    use Authenticatable, HasFactory, SoftDeletes;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'clock_number';

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'clock_number',
        'first_name',
        'last_name',
        'hire_date',
    ];

    /**
     * The attributes that are filterable.
     */
    protected array $filterable = [
        'clock_number',
        'first_name',
        'last_name',
    ];

    /**
     * Get the indexable data array for the model.
     *
     * @return array<string, mixed>
     */
    public function toSearchableArray(): array
    {
        return [
            'clock_number' => $this->clock_number,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
        ];
    }

    /**
     * Get the user account for the teammate.
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'guid', 'user_guid');
    }
}
