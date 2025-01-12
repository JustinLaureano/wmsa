<?php

namespace App\Models;

use App\Domain\Messaging\Contracts\MessengerContract;
use App\Support\Eloquent\Filter\Filterable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;
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
    protected $primaryKey = 'uuid';

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
        'domain_account_guid',
        'teammate_clock_number',
    ];

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
     * Get the user's conversation message.
     */
    public function message(): MorphOne
    {
        return $this->morphOne(Message::class, 'sender');
    }

    /**
     * Get the message status for a user's message.
     */
    public function messageStatus(): MorphOne
    {
        return $this->morphOne(MessageStatus::class, 'participant');
    }

    /**
     * Get the organization for the user.
     */
    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class, 'organization_id', 'id');
    }

    /**
     * Get the user as a participant of a conversation.
     */
    public function participant(): MorphOne
    {
        return $this->morphOne(Message::class, 'participant');
    }

    /**
     * Get the user account for the teammate.
     */
    public function teammate(): HasOne
    {
        return $this->hasOne(Teammate::class, 'clock_number', 'teammate_clock_number');
    }
}
