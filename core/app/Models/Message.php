<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Message extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'conversation_uuid',
        'sender_id',
        'sender_type'
    ];

    /**
     * Get the conversation for the message.
     */
    public function conversation(): BelongsTo
    {
        return $this->belongsTo(Conversation::class, 'conversation_uuid', 'uuid');
    }

    /**
     * Get the sender of the message.
     */
    public function sender(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get the status of the message.
     */
    public function status(): HasMany
    {
        return $this->hasMany(MessageStatus::class, 'message_uuid', 'uuid');
    }
}
