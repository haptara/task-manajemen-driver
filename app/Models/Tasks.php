<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;


class Tasks extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'slug',
        'title',
        'description',
        'status',
        'estimated_duration',
        'actual_duration',
        'assigned_driver_id',
        'created_by_admin_id',
        'vehicle_id'

    ];

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'assigned_driver_id');
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'assigned_driver_id');
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
