<?php

namespace Eduka\Cube\Models;

use Eduka\Cube\Abstracts\EdukaModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends EdukaModel
{
    use SoftDeletes;

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function videos()
    {
        return $this->belongsToMany(Video::class)
                    ->withTimestamps();
    }
}
