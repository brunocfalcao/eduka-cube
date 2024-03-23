<?php

namespace Eduka\Cube\Models;

use Brunocfalcao\LaravelHelpers\Traits\ForModels\HasAutoIncrementsByGroup;
use Brunocfalcao\LaravelHelpers\Traits\ForModels\HasCustomQueryBuilder;
use Brunocfalcao\LaravelHelpers\Traits\ForModels\HasValidations;
use Eduka\Abstracts\Classes\EdukaModel;

class Chapter extends EdukaModel
{
    use HasAutoIncrementsByGroup,
        HasCustomQueryBuilder,
        HasValidations;

    protected $casts = [
        'prelaunched_at' => 'datetime',
        'launched_at' => 'datetime',
        'retired_at' => 'datetime',
    ];

    public $rules = [
        'course_id' => ['required', 'exists:courses,id'],
        'index' => ['required'],
        'name' => ['required', 'string'],
        'description' => ['nullable'],
        'vimeo_uri' => ['nullable', 'string'],
    ];

    // Relationship registered.
    public function episodes()
    {
        return $this->hasMany(Episode::class);
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
        return ! $this->episodes()->withTrashed()->exists();
    }
}
