<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Driver extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable =   [
        'name',
        'email',
        'phone'
    ];

    public function tasks()
    {
        return $this->hasMany(Tasks::class, 'assigned_driver_id');
    }

    public function checkIn()
    {
        return $this->hasMany(Check_in::class);
    }

    public function checkOut()
    {
        return $this->hasMany(Check_out::class);
    }
}
