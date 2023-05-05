<?php

namespace Eduka\Cube\Models;

use Eduka\Analytics\Models\Visit;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

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

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function visits()
    {
        return $this->hasMany(Visit::class);
    }

    public function videosCompleted()
    {
        return $this->belongsToMany(Video::class, 'videos_completed');
    }
}
