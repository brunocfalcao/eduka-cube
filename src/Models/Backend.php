<?php

namespace Eduka\Cube\Models;

use Brunocfalcao\LaravelHelpers\Traits\ForModels\HasCustomQueryBuilder;
use Brunocfalcao\LaravelHelpers\Traits\ForModels\HasValidations;
use Eduka\Abstracts\Classes\EdukaModel;

class Backend extends EdukaModel
{
    use HasCustomQueryBuilder,
        HasValidations;

    public $rules = [
        'name' => ['required'],
        'domain' => ['required'],
        'provider_namespace' => ['required', 'class_exists'],
    ];

    protected $casts = [
        'theme' => 'array',
    ];

    // Relationship registered.
    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    // Relationship registered.
    public function requestLogs()
    {
        return $this->hasMany(RequestLog::class);
    }

    public function canBeDeleted()
    {
        // For now, a backend cannot be deleted.
        return false;
    }
}
