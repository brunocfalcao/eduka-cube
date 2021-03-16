<?php

namespace Eduka\Cube\Models;

use Eduka\Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'subscriber_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'was_subscriber' => 'boolean',
    ];

    public function favoriteVideos()
    {
        return $this->belongsToMany(Video::class, 'favorites')
                    ->as('favorite')
                    ->withTimestamps();
    }

    public function watchLaterVideos()
    {
        return $this->belongsToMany(Video::class, 'watch_later')
                    ->as('watch_later')
                    ->withTimestamps();
    }

    public function markedAsSeenVideos()
    {
        return $this->belongsToMany(Video::class, 'marked_as_seen')
                    ->as('marked_as_seen')
                    ->withTimestamps();
    }

    public function subscriber()
    {
        return $this->belongsTo(Subscriber::class);
    }

    public function logs()
    {
        return $this->hasMany(ApplicationLog::class, 'causer_id');
    }

    protected static function newFactory()
    {
        return UserFactory::new();
    }
}
