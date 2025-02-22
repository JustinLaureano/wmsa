<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MessageStatus extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'message_status';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'message_uuid',
        'participant_id',
        'participant_type',
        'is_read',
        'read_at',
    ];

    /**
     * Get the message for the status.
     */
    public function message(): BelongsTo
    {
        return $this->belongsTo(Message::class, 'message_uuid', 'uuid');
    }
}
