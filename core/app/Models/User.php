<?php

namespace App\Models;

use App\Domain\Messaging\Contracts\MessengerContract;
use App\Support\Eloquent\Filter\Filterable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Scout\Searchable;
use LdapRecord\Laravel\Auth\AuthenticatesWithLdap;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MessengerContract
{
    use AuthenticatesWithLdap,
        Filterable,
        HasApiTokens,
        HasFactory,
        HasRoles,
        HasUuids,
        Notifiable,
        Searchable;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'guid';

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

    /**
     * The authentication guard driver for the user model.
     *
     * This variables only use is to enforce roles/permissions
     * and does not affect application authentication.
     */
    protected string $guard_name = 'web';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'organization_id',
        'username',
        'first_name',
        'last_name',
        'display_name',
        'title',
        'description',
        'email',
        'domain',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    /**
     * The attributes that are filterable.
     */
    protected array $filterable = [
        'username',
        'first_name',
        'last_name',
        'title',
        'description',
        'email',
    ];

    public static $objectClasses = [
        'top',
        'person',
        'organizationalperson',
        'user',
    ];

    public function getMessengerId(): string
    {
        return $this->uuid;
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array<string, mixed>
     */
    public function toSearchableArray(): array
    {
        return [
            'username' => $this->username,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'title' => $this->title,
            'description' => $this->description,
            'email' => $this->email,
        ];
    }

    /**
     * Get the organization for the user.
     */
    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class, 'organization_id', 'id');
    }

    /**
     * Get the teammate for the user.
     */
    public function teammate(): HasOne
    {
        return $this->hasOne(Teammate::class, 'user_guid', 'guid');
    }

    /**
     * Scope a query to filter on the barcode column.
     */
    public function scopeWhereName(Builder $query, string $firstName, string $lastName): void
    {
        $query->where([
            ['first_name', $firstName],
            ['last_name', $lastName]
        ]);
    }
}
