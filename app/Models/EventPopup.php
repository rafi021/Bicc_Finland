<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventPopup extends Model
{
    protected $fillable = [
        'event_name',
        'message',
        'event_datetime',
        'is_active',
    ];

    protected $casts = [
        'event_datetime' => 'datetime',
        'is_active' => 'boolean',
    ];
}
