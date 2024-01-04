<?php

namespace Eduka\Cube\Models;

use Brunocfalcao\LaravelHelpers\Traits\HasCustomQueryBuilder;
use Eduka\Abstracts\Classes\EdukaModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends EdukaModel
{
    use HasCustomQueryBuilder, SoftDeletes;

    protected $casts = [
        'is_visible' => 'boolean',
        'is_active' => 'boolean',
        'is_free' => 'boolean',
        'duration' => 'integer',
    ];

    // Relationship registered.
    public function usersThatCompleted()
    {
        return $this->belongsToMany(User::class, 'user_video_completed');
    }

    // Relationship registered.
    public function usersThatBookmarked()
    {
        return $this->belongsToMany(User::class, 'user_video_bookmarked');
    }

    // Relationship registered.
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Relationship registered.
    public function links()
    {
        return $this->hasMany(Link::class);
    }

    // Relationship verified.
    public function tags()
    {
        return $this->belongsToMany(Tag::class)
                    ->withTimestamps();
    }

    public function series()
    {
        return $this->belongsToMany(Series::class)
                    ->withTimestamps();
    }

    // Relationship registered.
    public function chapters()
    {
        return $this->belongsToMany(Chapter::class)
                    ->withTimestamps();
    }
}
