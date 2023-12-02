<?php

namespace Eduka\Cube\Observers;

use Eduka\Cube\Models\Video;
use Illuminate\Support\Str;

class VideoObserver
{
    public function saving(Video $video)
    {
        // Default column computations in case they came null/empty.
        if (empty($video->uuid)) {
            $video->uuid = (string) Str::uuid();
        }
    }
}
