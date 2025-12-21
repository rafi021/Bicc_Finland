<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IslamicClass extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'category',
        'days',
        'time',
        'image',
    ];

    public function registrations()
    {
        return $this->hasMany(ClassRegistration::class);
    }
}
