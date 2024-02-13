<?php

namespace Eduka\Cube\Models;

use Brunocfalcao\LaravelHelpers\Traits\HasCustomQueryBuilder;
use Brunocfalcao\LaravelHelpers\Traits\HasValidations;
use Brunocfalcao\LaravelNovaHelpers\Traits\DefaultAscPKSorting;
use Eduka\Abstracts\Classes\EdukaModel;

class RequestLog extends EdukaModel
{
    use DefaultAscPKSorting,
        HasCustomQueryBuilder, HasValidations;

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

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
