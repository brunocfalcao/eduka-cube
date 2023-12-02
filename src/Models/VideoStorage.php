<?php

namespace Eduka\Cube\Models;

use Eduka\Cube\Abstracts\EdukaModel;

class VideoStorage extends EdukaModel
{
    protected $table = 'video_storages';

    public function video()
    {
        return $this->belongsTo(Video::class, 'video_id');
    }
}
