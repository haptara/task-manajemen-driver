<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'slug',
        'title',
        'description',
        'board_id',
        'assigned_driver_id',
        'vehicle_id',
        'check_in',
        'check_out',
        'starting_from',
        'finished_in',
        'estimated_duration',
        'duration',
        'status',
    ];

    public function setTitleAttribute($value)
    {
        // $this->attributes['title'] = $value;
        // $this->attributes['slug'] = Str::slug($value);
        $this->attributes['title'] = $value;

        $slug = Str::slug($value);
        $originalSlug = $slug;
        $count = 1;

        while (self::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        $this->attributes['slug'] = $slug;
    }

    public function board()
    {
        return $this->belongsTo(Board::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'assigned_driver_id');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
