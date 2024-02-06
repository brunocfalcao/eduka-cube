<?php

namespace Eduka\Cube\Models;

use Brunocfalcao\LaravelHelpers\Traits\HasCustomQueryBuilder;
use Brunocfalcao\LaravelHelpers\Traits\HasValidations;
use Eduka\Abstracts\Classes\EdukaModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organization extends EdukaModel
{
    use HasCustomQueryBuilder,
        HasValidations,
        SoftDeletes;

    protected $casts = [
    ];

    public $rules = [
        'name' => ['required'],
        'domain' => ['required'],
        'provider_namespace' => ['required'],
    ];

    // Relationship registered.
    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function canBeDeleted()
    {
        // For now, an organization cannot be deleted.
        return false;
    }
}
