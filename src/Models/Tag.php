<?php

namespace Eduka\Cube\Models;

use Brunocfalcao\LaravelHelpers\Traits\HasCustomQueryBuilder;
use Brunocfalcao\LaravelHelpers\Traits\HasValidations;
use Eduka\Abstracts\Classes\EdukaModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends EdukaModel
{
    use HasCustomQueryBuilder,
        HasValidations,
        SoftDeletes;

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
