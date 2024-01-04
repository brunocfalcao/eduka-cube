<?php

namespace Eduka\Cube\Models;

use Brunocfalcao\LaravelHelpers\Traits\HasCustomQueryBuilder;
use Eduka\Abstracts\Classes\EdukaModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends EdukaModel
{
    use HasCustomQueryBuilder, SoftDeletes;

    // Relationship registered.
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Relationship registered.
    public function videos()
    {
        return $this->belongsToMany(Video::class)
                    ->withTimestamps();
    }
}
