<?php

namespace Eduka\Cube\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Subscriber extends Model
{
    use Notifiable, SoftDeletes;

    protected $guarded = [];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
