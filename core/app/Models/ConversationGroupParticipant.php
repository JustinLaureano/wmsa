<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConversationGroupParticipant extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'conversation_group_uuid',
        'participant_id',
        'participant_type',
    ];

    /**
     * Get the conversation group for the participant.
     */
    public function group(): BelongsTo
    {
        return $this->belongsTo(ConversationGroup::class, 'conversation_group_uuid', 'uuid');
    }
}
