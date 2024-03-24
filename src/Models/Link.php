<?php

namespace Eduka\Cube\Models;

use Brunocfalcao\LaravelHelpers\Traits\ForModels\HasCustomQueryBuilder;
use Brunocfalcao\LaravelHelpers\Traits\ForModels\HasValidations;
use Eduka\Abstracts\Classes\EdukaModel;

class Link extends EdukaModel
{
    use HasCustomQueryBuilder, HasValidations;

    public $rules = [
        'name' => ['required', 'string'],
        'url' => ['required', 'url'],
        'episode_id' => ['required', 'exists:episodes,id'],
    ];

    // Relationship registered.
    public function episode()
    {
        return $this->belongsTo(Episode::class);
    }
}
