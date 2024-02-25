<?php

namespace Eduka\Cube\Models;

use Brunocfalcao\LaravelHelpers\Traits\HasAutoIncrementsByGroup;
use Brunocfalcao\LaravelHelpers\Traits\HasCustomQueryBuilder;
use Brunocfalcao\LaravelHelpers\Traits\HasValidations;
use Eduka\Abstracts\Classes\EdukaModel;
use Eduka\Cube\Concerns\VideoFeatures;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends EdukaModel
{
    use HasAutoIncrementsByGroup,
        HasCustomQueryBuilder,
        HasValidations,
        SoftDeletes,
        VideoFeatures;

    protected $casts = [
        'is_visible' => 'boolean',
        'is_active' => 'boolean',
        'is_free' => 'boolean',

        'duration' => 'integer',

        'meta_names' => 'array',
        'meta_properties' => 'array',
    ];

    public $rules = [
        'name' => ['required', 'string'],
        'description' => ['nullable'],
        'index' => ['required'],
        'course_id' => ['required', 'exists:courses,id'],
        'meta_names' => ['nullable'],
        'meta_properties' => ['nullable'],
        'duration' => ['nullable', 'integer'],
        'is_visible' => ['nullable', 'boolean'],
        'is_active' => ['nullable', 'boolean'],
        'is_free' => ['nullable', 'boolean'],
        'vimeo_id' => ['nullable', 'string'],
        'filename' => ['nullable', 'string'],
    ];

    // Relationship registered.
    public function usersThatBookmarked()
    {
        return $this->belongsToMany(User::class, 'user_video_bookmarked');
    }

    // Relationship registered.
    public function usersThatSaw()
    {
        return $this->belongsToMany(User::class, 'user_video_seen');
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

    // Relationship registered.
    public function series()
    {
        return $this->belongsToMany(Series::class)
            ->withTimestamps();
    }

    // Relationship registered.
    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }
}
