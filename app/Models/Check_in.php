<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Check_in extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'timestamp',
        'location',
        'task_id',
        'driver_id',
    ];

    public function task()
    {
        return $this->belongsTo(Tasks::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}
