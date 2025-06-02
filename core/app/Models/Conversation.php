<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conversation extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'group_conversation'
    ];

    /**
     * Get the latest message for the conversation.
     */
    public function latestMessage(): HasOne
    {
        return $this->hasOne(Message::class, 'conversation_uuid', 'uuid')
            ->orderBy('created_at', 'DESC');
    }

    /**
     * Get the messages for the conversation.
     */
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class, 'conversation_uuid', 'uuid');
    }

    /**
     * Get the participants for the conversation.
     */
    public function participants(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'conversation_participants',
            'conversation_uuid',
            'user_uuid',
            'uuid',
            'uuid'
        )
        ->withTimestamps();
    }

    /**
     * Scope a query to filter on the barcode column.
     */
    public function scopeWhereParticipant(Builder $query, string $user_uuid): void
    {
        $query->whereHas('participants', function (Builder $builder) use ($user_uuid) {
            $builder->where('user_uuid', $user_uuid);
        });
    }
}
