<?php

namespace Eduka\Cube\Models;

use Brunocfalcao\LaravelHelpers\Traits\HasCustomQueryBuilder;
use Brunocfalcao\LaravelHelpers\Traits\HasValidations;
use Eduka\Abstracts\Classes\EdukaModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Link extends EdukaModel
{
    use HasCustomQueryBuilder, HasValidations, SoftDeletes;

    public $rules = [
        'name' => ['required', 'string'],
        'url' => ['required', 'url'],
        'video_id' => ['required', 'exists:videos,id'],
    ];

    // Relationship registered.
    public function video()
    {
        return $this->belongsTo(Video::class);
    }
}
