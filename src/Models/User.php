<?php

namespace Eduka\Cube\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use LemonSqueezy\Laravel\Billable;

class User extends Authenticatable
{
    use Billable;
    use Notifiable;
    use SoftDeletes;

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'receives_notifications' => 'boolean',
    ];

    public function scopeWithOldId($query, $id)
    {
        return $query->where('old_id', $id);
    }

    public function videos()
    {
        return $this->hasMany(Video::class, 'created_by');
    }

    public function variants()
    {
        return $this->belongsToMany(Variant::class)
                    ->withTimestamps();
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class)
                    ->withTimestamps();
    }

    public function getCoursesAttribute()
    {
        $courses = $this->variants->map(function (Variant $variant) {
            return $variant->course;
        });

        $uniqueCourses = $courses->unique()->values();

        return $uniqueCourses;
    }
}
