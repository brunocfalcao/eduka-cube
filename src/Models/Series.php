<?php

namespace Eduka\Cube\Models;

use Eduka\Abstracts\Classes\EdukaModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Series extends EdukaModel
{
    use SoftDeletes;

    public function courses()
    {
        return $this->belongsTo(Course::class);
    }

    public function videos()
    {
        return $this->belongsToMany(Video::class)
                    ->withTimestamps();
    }
}
