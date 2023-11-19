<?php

namespace Eduka\Cube\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use LemonSqueezy\Laravel\Billable;
use MasteringNova\Database\Factories\UserFactory;

class User extends Authenticatable
{
    use Billable, HasFactory, Notifiable, SoftDeletes;

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
        return $this->belongsToMany(Course::class)
                    ->withTimestamps();
    }

    public function visits()
    {
        return $this->hasMany(Visit::class);
    }

    public function videosCompleted()
    {
        return $this->belongsToMany(Video::class, 'videos_completed');
    }

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory(): Factory
    {
        return UserFactory::new();
    }
}
