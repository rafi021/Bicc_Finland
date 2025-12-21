<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'islamic_class_id',
        'name',
        'email',
        'phone',
        'message',
    ];

    public function islamicClass()
    {
        return $this->belongsTo(IslamicClass::class);
    }
}
