<?php

namespace Eduka\Cube\Models;

use Brunocfalcao\LaravelHelpers\Traits\HasAutoIncrementsByGroup;
use Brunocfalcao\LaravelHelpers\Traits\HasCustomQueryBuilder;
use Brunocfalcao\LaravelHelpers\Traits\HasValidations;
use Eduka\Abstracts\Classes\EdukaModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class EdukaRequestLog extends EdukaModel
{
    use HasCustomQueryBuilder,
        HasValidations,
        SoftDeletes;

    protected $casts = [
        'request_payload' => 'array',
        'request_headers' => 'array'
    ];

    public $rules = [
        'referer'          => ['nullable', 'string'],
        'url'              => ['required', 'string'],
        'request_payload'  => ['required', 'string'],
        'request_headers'  => ['required', 'string'],
    ];
}
