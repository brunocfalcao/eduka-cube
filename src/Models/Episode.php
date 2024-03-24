<?php

namespace Eduka\Cube\Models;

use Brunocfalcao\LaravelHelpers\Traits\ForModels\HasAutoIncrementsByGroup;
use Brunocfalcao\LaravelHelpers\Traits\ForModels\HasCanonicals;
use Brunocfalcao\LaravelHelpers\Traits\ForModels\HasCustomQueryBuilder;
use Brunocfalcao\LaravelHelpers\Traits\ForModels\HasUuids;
use Brunocfalcao\LaravelHelpers\Traits\ForModels\HasValidations;
use Eduka\Abstracts\Classes\EdukaModel;
use Eduka\Cube\Concerns\EpisodeFeatures;
use Illuminate\Validation\Rule;

class Episode extends EdukaModel
{
    use EpisodeFeatures,
        HasAutoIncrementsByGroup,
        HasCanonicals,
        HasCustomQueryBuilder,
        HasUuids,
        HasValidations;

    protected $casts = [
        'is_visible' => 'boolean',
        'is_active' => 'boolean',
        'is_free' => 'boolean',

        'duration' => 'integer',
    ];

    public $rules = [
        'name' => ['required', 'string'],
        'description' => ['nullable'],
        'index' => ['required'],
        'course_id' => ['required', 'exists:courses,id'],
        'duration' => ['nullable', 'integer'],
        'is_visible' => ['nullable', 'boolean'],
        'is_active' => ['nullable', 'boolean'],
        'is_free' => ['nullable', 'boolean'],
        'vimeo_id' => ['nullable', 'string'],
        'filename' => ['nullable', 'string'],
    ];

    public function getRules()
    {
        return [
            'uuid' => ['required', Rule::unique('episodes')->ignore($this->id)],
            'canonical' => ['required', Rule::unique('episodes')->ignore($this->id)],
        ];
    }

    // Relationship registered.
    public function studentsThatBookmarked()
    {
        return $this->belongsToMany(Student::class, 'student_episode_bookmarked');
    }

    // Relationship registered.
    public function studentsThatSaw()
    {
        return $this->belongsToMany(Student::class, 'student_episode_seen');
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
