<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConversationParticipant extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'conversation_uuid',
        'user_uuid',
    ];

    /**
     * Get the conversation for the participant.
     */
    public function conversation(): BelongsTo
    {
        return $this->belongsTo(Conversation::class, 'conversation_uuid', 'uuid');
    }

    /**
     * Get the participant for the conversation.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_uuid', 'uuid');
    }
}
