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
        'no_handphone',
        'status',
        'is_active'
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function vehicle()
    {
        return $this->hasMany(Vehicle::class);
    }
}
