<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    protected $fillable = ['service_id', 'name', 'email', 'phone', 'message'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
