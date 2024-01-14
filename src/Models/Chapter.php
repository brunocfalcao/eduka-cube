<?php

namespace Eduka\Cube\Models;

use Brunocfalcao\LaravelHelpers\Traits\HasCustomQueryBuilder;
use Eduka\Abstracts\Classes\EdukaModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chapter extends EdukaModel
{
    use HasCustomQueryBuilder, SoftDeletes;

    // Relationship registered.
    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    // Relationship registered.
    public function variants()
    {
        return $this->belongsToMany(Variant::class)
                    ->withTimestamps();
    }

    // Relationship registered.
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
