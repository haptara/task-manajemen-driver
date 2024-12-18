<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'license_plate',
        'model',
        'status',
        'driver_id'
    ];

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function tasks()
    {
        return $this->hasMany(Tasks::class);
    }
}
