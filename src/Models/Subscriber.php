<?php

namespace Eduka\Cube\Models;

use Brunocfalcao\LaravelHelpers\Traits\HasCustomQueryBuilder;
use Eduka\Abstracts\Classes\EdukaModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Subscriber extends EdukaModel
{
    use HasCustomQueryBuilder, Notifiable, SoftDeletes;

    // Relationship registered.
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
