<?php

namespace Eduka\Cube\Models;

use Illuminate\Database\Eloquent\Model;

class ChapterVideo extends Model
{
    // use HasFactory, SoftDeletes;
    protected $table = 'chapter_video';

    protected $guarded = [];

    public function videos()
    {
        return $this->hasMany(Video::class, 'id', 'video_id');
    }
}
