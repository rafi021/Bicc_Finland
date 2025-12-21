<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MissionInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'video_id',
        'video_thumbnail',
    ];
}
