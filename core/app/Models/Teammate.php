<?php

namespace App\Models;

use App\Domain\Materials\Contracts\HandlerContract;
use App\Domain\Messaging\Contracts\MessengerContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Teammate extends Model implements AuthenticatableContract, HandlerContract, MessengerContract
{
    use Authenticatable,
        HasFactory,
        HasRoles,
        Notifiable,
        SoftDeletes;

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
     * The authentication guard driver for the user model.
     *
     * This variables only use is to enforce roles/permissions
     * and does not affect application authentication.
     */
    protected string $guard_name = 'web';

    public function getHandlerId(): string
    {
        return $this->clock_number;
    }

    public function getMessengerId(): string
    {
        return $this->clock_number;
    }

    /**
     * Returns the default guard for the model.
     *
     * This variables only use is to enforce roles/permissions
     * and does not affect application authentication.
     */
    protected function getDefaultGuardName(): string { return 'web'; }

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
     * Get the teammate's conversation message.
     */
    public function message(): MorphOne
    {
        return $this->morphOne(Message::class, 'sender');
    }

    /**
     * Get the user account for the teammate.
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'guid', 'user_guid');
    }

    /**
     * Scope a query to filter on the clock number column.
     */
    public function scopeWhereClockNumber(Builder $query, string $clockNumber): void
    {
        $query->where('clock_number', $clockNumber);
    }
}
