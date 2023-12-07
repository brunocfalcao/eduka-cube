<?php

namespace Eduka\Cube\Models;

use Eduka\Cube\Abstracts\EdukaModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Domain extends EdukaModel
{
    use SoftDeletes;

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
