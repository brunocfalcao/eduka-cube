<?php

namespace Eduka\Cube\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Domain extends Model
{
    use Notifiable;
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'course_id' => 'integer',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
