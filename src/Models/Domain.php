<?php

namespace Eduka\Cube\Models;

use Eduka\Cube\Abstracts\EdukaModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Domain extends EdukaModel
{
    use Notifiable, SoftDeletes;

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
