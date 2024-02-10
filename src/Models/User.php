<?php

namespace Eduka\Cube\Models;

use Brunocfalcao\LaravelHelpers\Traits\HasCustomQueryBuilder;
use Brunocfalcao\LaravelHelpers\Traits\HasValidations;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use LemonSqueezy\Laravel\Billable;

class User extends Authenticatable
{
    use Billable,
        HasCustomQueryBuilder,
        HasValidations,
        Notifiable,
        SoftDeletes;

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
    ];

    public $rules = [
        'name' => ['nullable', 'string'],
        'email' => ['required'],
        'password' => ['nullable', 'string'],
        'twitter_handle' => ['nullable', 'string'],
        'course_id_as_admin' => ['nullable', 'exists:courses,id'],
        'remember_token' => ['nullable', 'string'],
    ];

    public function canBeDeleted()
    {
        return true;
    }

    // Relationship registered.
    public function videosThatWereCompleted()
    {
        return $this->belongsToMany(Video::class, 'user_video_completed')
            ->withTimestamps();
    }

    // Relationship registered.
    public function videosThatWereBookmarked()
    {
        return $this->belongsToMany(Video::class, 'user_video_bookmarked')
            ->withTimestamps();
    }

    // Relationship registered.
    public function variants()
    {
        return $this->belongsToMany(Variant::class)
            ->withTimestamps();
    }

    // Relationship registered.
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // Relationship registered.
    public function courses()
    {
        return $this->belongsToMany(Course::class)
            ->withTimestamps();
    }

    // Relationship registered.
    public function courseAsAdmin()
    {
        return $this->belongsTo(Course::class, 'course_id_as_admin');
    }
}
