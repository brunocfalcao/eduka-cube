<?php

namespace Eduka\Cube\Models;

use Eduka\Cube\Abstracts\EdukaModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chapter extends EdukaModel
{
    use SoftDeletes;

    public function videos()
    {
        return $this->belongsToMany(Video::class);
    }

    public function variants()
    {
        return $this->belongsToMany(Variant::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
