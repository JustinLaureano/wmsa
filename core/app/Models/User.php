<?php

namespace App\Models;

use App\Support\Eloquent\Filter\Filterable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Scout\Searchable;
use LdapRecord\Laravel\Auth\AuthenticatesWithLdap;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
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

    protected $hidden = [
        'organization_id',
        'remember_token',
        'created_at',
        'updated_at',
        'deleted_at',
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
     * Get the domain account for the user.
     */
    public function domainAccount(): HasOne
    {
        return $this->hasOne(DomainAccount::class, 'guid', 'domain_account_guid');
    }

    /**
     * Get the conversations for the user.
     */
    public function conversations(): BelongsToMany
    {
        return $this->belongsToMany(
            Conversation::class,
            'conversation_participants',
            'user_uuid',
            'conversation_uuid'
        )
        ->withTimestamps();
    }

    /**
     * Get the messages for the user.
     */
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class, 'user_uuid', 'uuid');
    }

    /**
     * Get the message statuses for the user.
     */
    public function messageStatuses(): HasMany
    {
        return $this->hasMany(MessageStatus::class, 'user_uuid', 'uuid');
    }

    /**
     * Get the conversation participants for the user.
     */
    public function conversationParticipants(): HasMany
    {
        return $this->hasMany(ConversationParticipant::class, 'user_uuid', 'uuid');
    }

    /**
     * Get the conversation group participants for the user.
     */
    public function conversationGroupParticipants(): HasMany
    {
        return $this->hasMany(ConversationGroupParticipant::class, 'user_uuid', 'uuid');
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
        return $this->hasOne(Teammate::class, 'clock_number', 'teammate_clock_number');
    }

    /**
     * Get the user settings for the user.
     */
    public function settings(): HasOne
    {
        return $this->hasOne(UserSetting::class, 'user_uuid', 'uuid');
    }

    /**
     * Get the notification preferences for the user.
     */
    public function notificationPreferences(): HasMany
    {
        return $this->hasMany(NofificationPreference::class, 'user_uuid', 'uuid');
    }
}