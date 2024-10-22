<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConversationGroup extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'name',
    ];

    /**
     * Get the participants for the conversation group.
     */
    public function participants(): HasMany
    {
        return $this->hasMany(ConversationGroupParticipant::class, 'conversation_group_uuid', 'uuid');
    }

    public function conversations(): HasManyThrough
    {
        return $this->hasManyThrough(
            Conversation::class,
            GroupConversation::class,
            'conversation_group_uuid', // group_conversations.conversation_group_uuid
            'uuid', // conversations.uuid
            'uuid', // conversation_groups.uuid
            'conversation_uuid', // group_conversations.conversation_uuid
        );
    }
}
