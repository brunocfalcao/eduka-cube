<?php

namespace Eduka\Cube\Models;

use Brunocfalcao\LaravelHelpers\Traits\HasCustomQueryBuilder;
use Brunocfalcao\LaravelHelpers\Traits\HasValidations;
use Eduka\Abstracts\Classes\EdukaModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Subscriber extends EdukaModel
{
    use HasCustomQueryBuilder,
        HasValidations,
        Notifiable,
        SoftDeletes;

    protected $casts = [
    ];

    public $rules = [
        'course_id' => ['required', 'exists:courses,id'],
        'email' => ['required'],
    ];

    // Relationship registered.
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
