<?php

namespace Eduka\Cube\Models;

use Brunocfalcao\LaravelHelpers\Traits\ForModels\HasCustomQueryBuilder;
use Brunocfalcao\LaravelHelpers\Traits\ForModels\HasValidations;
use Eduka\Cube\Concerns\StudentFeatures;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Student extends Authenticatable
{
    use StudentFeatures,
        HasCustomQueryBuilder,
        HasValidations,
        Notifiable;

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [];

    public $rules = [
        'name' => ['nullable', 'string'],
        'email' => ['required'],
        'password' => ['nullable', 'string'],
        'twitter_handle' => ['nullable', 'string'],
        'remember_token' => ['nullable', 'string'],
    ];

    // Relationship registered.
    public function asCourseAdmin()
    {
        return $this->hasOne(Course::class, 'student_admin_id');
    }

    // Relationship registered.
    public function episodesThatWereSeen()
    {
        return $this->belongsToMany(Episode::class, 'episode_student_seen')
            ->withTimestamps();
    }

    // Relationship registered.
    public function episodesThatWereBookmarked()
    {
        return $this->belongsToMany(Episode::class, 'episode_student_bookmarked')
            ->withTimestamps();
    }

    // Relationship registered.
    public function courses()
    {
        return $this->belongsToMany(Course::class)
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

    public function canBeDeleted()
    {
        return true;
    }
}
