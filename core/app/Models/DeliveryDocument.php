<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeliveryDocument extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'delivery_number',
        'ship_to_number',
        'ship_to_name',
        'request_date',
        'delivery_posted_at',
    ];

    protected $casts = [
        'request_date' => 'datetime',
        'delivery_posted_at' => 'datetime',
    ];
}