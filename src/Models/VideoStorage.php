<?php

namespace Eduka\Cube\Models;

use Illuminate\Database\Eloquent\Model;

class VideoStorage extends Model
{
    protected $guarded = [];

    protected $table = 'video_storages';

    public function video()
    {
        return $this->belongsTo(Video::class,'video_id');
    }
}
