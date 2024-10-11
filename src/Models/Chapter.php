<?php

namespace Eduka\Cube\Models;

use Brunocfalcao\LaravelHelpers\Traits\ForModels\HasAutoIncrementsByGroup;
use Brunocfalcao\LaravelHelpers\Traits\ForModels\HasCustomQueryBuilder;
use Brunocfalcao\LaravelHelpers\Traits\ForModels\HasValidations;
use Brunocfalcao\LaravelHelpers\Traits\ForModels\HasUuids;
use Eduka\Abstracts\Classes\EdukaModel;
use Illuminate\Validation\Rule;

class Chapter extends EdukaModel
{
    use HasAutoIncrementsByGroup,
        HasCustomQueryBuilder,
        HasUuids,
        HasValidations;

    protected $with = ['course'];

    protected $casts = [
        'prelaunched_at' => 'datetime',
        'launched_at' => 'datetime',
        'retired_at' => 'datetime',
    ];

    public $rules = [
        'course_id' => ['required', 'exists:courses,id'],
        'index' => ['required'],
        'uuid' => ['required'],
        'name' => ['required', 'string'],
        'description' => ['nullable'],
        'vimeo_uri' => ['nullable', 'string'],
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }

    // Relationship registered.
    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }

    public function activeEpisodes()
    {
        return $this->hasMany(Episode::class)->where('episodes.is_active', true)->orderBy('episodes.index');
    }

    // Relationship registered.
    public function variants()
    {
        return $this->belongsToMany(Variant::class)
            ->withTimestamps();
    }

    // Relationship registered.
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function canBeDeleted()
    {
        // No active episodes (including trashed) part of this chapter.
        return ! $this->episodes()->exists();
    }
}
