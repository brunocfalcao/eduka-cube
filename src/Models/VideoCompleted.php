<?php

namespace Eduka\Cube\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VideoCompleted extends Model
{
    use SoftDeletes;

    protected $table = 'videos_completed';

    protected $guarded = [];

    public function video()
    {
        return $this->belongsTo(Video::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
