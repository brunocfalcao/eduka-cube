<?php

namespace Eduka\Cube\Models;

use Brunocfalcao\LaravelHelpers\Traits\HasCustomQueryBuilder;
use Eduka\Abstracts\Classes\EdukaModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Link extends EdukaModel
{
    use HasCustomQueryBuilder, SoftDeletes;

    // Relatioship registered.
    public function video()
    {
        return $this->belongsTo(Video::class);
    }
}
