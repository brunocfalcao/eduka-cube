<?php

namespace Eduka\Cube\Models;

use Brunocfalcao\LaravelHelpers\Traits\ForModels\HasCustomQueryBuilder;
use Brunocfalcao\LaravelHelpers\Traits\ForModels\HasValidations;
use Eduka\Abstracts\Classes\EdukaModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Backend extends EdukaModel
{
    use HasCustomQueryBuilder,
        HasValidations,
        SoftDeletes;

    protected $casts = [
    ];

    public $rules = [
        'name' => ['required'],
        'domain' => ['required'],
        'provider_namespace' => ['required', 'class_exists'],
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
