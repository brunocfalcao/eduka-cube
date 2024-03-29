<?php

namespace Eduka\Cube\Models;

use Brunocfalcao\LaravelHelpers\Traits\ForModels\HasCustomQueryBuilder;
use Brunocfalcao\LaravelHelpers\Traits\ForModels\HasValidations;
use Eduka\Abstracts\Classes\EdukaModel;

class Tag extends EdukaModel
{
    use HasCustomQueryBuilder,
        HasValidations;

    protected $with = ['course'];

    public $rules = [
        'name' => ['required', 'string'],
        'description' => ['nullable'],
        'course_id' => ['required', 'exists:courses,id'],
    ];

    // Relationship registered.
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Relationship registered.
    public function episodes()
    {
        return $this->belongsToMany(Episode::class)
            ->withTimestamps();
    }
}
