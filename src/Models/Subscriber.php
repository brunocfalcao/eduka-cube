<?php

namespace Eduka\Cube\Models;

use Eduka\Abstracts\Classes\EdukaModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Subscriber extends EdukaModel
{
    use Notifiable, SoftDeletes;

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
