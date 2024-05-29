<?php

namespace Eduka\Cube\Models;

use Brunocfalcao\LaravelHelpers\Traits\ForModels\HasCustomQueryBuilder;
use Brunocfalcao\LaravelHelpers\Traits\ForModels\HasValidations;
use Eduka\Abstracts\Classes\EdukaModel;

class RequestLog extends EdukaModel
{
    use HasCustomQueryBuilder,
        HasValidations;

    protected $with = ['backend', 'student', 'course'];

    protected $casts = [
        'payload' => 'array',
        'headers' => 'array',
        'parameters' => 'array',
        'middleware' => 'array',
        'payload' => 'array',
    ];

    public $rules = [
        'referer' => ['nullable', 'string'],
        'url' => ['required', 'string'],
        'payload' => ['required', 'string'],
        'headers' => ['required', 'string'],
    ];

    public function backend()
    {
        return $this->belongsTo(Backend::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
