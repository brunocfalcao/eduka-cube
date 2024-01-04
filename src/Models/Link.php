<?php

namespace Eduka\Cube\Models;

use Eduka\Abstracts\Classes\EdukaModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Link extends EdukaModel
{
    use SoftDeletes;

    public function video()
    {
        return $this->belongsTo(Video::class);
    }
}
