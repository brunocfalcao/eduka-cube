<?php

namespace Eduka\Cube\Models;

use Brunocfalcao\LaravelHelpers\Traits\HasAutoIncrementsByGroup;
use Brunocfalcao\LaravelHelpers\Traits\HasCustomQueryBuilder;
use Brunocfalcao\LaravelHelpers\Traits\HasValidations;
use Eduka\Abstracts\Classes\EdukaModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chapter extends EdukaModel
{
    use HasAutoIncrementsByGroup,
        HasCustomQueryBuilder,
        HasValidations,
        SoftDeletes;

    protected $casts = [
        'meta_names' => 'array',
        'meta_properties' => 'array',

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
        'vimeo_folder_id' => ['nullable', 'string'],
    ];

    // Relationship registered.
    public function videos()
    {
        return $this->hasMany(Video::class);
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
        // No active videos (including trashed) part of this chapter.
        return ! $this->videos()->withTrashed()->exists();
    }
}
