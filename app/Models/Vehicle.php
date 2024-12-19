<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'driver_id',
        'vehicle_number',
        'merk',
        'type',
        'status'
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}
