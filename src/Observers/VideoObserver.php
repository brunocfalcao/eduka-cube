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

    public function saved(Video $video)
    {
        //
    }

    public function created(Video $video)
    {
        //
    }

    public function updated(Video $video)
    {
        //
    }

    public function deleted(Video $video)
    {
        //
    }

    public function restored(Video $video)
    {
        //
    }

    public function forceDeleted(Video $video)
    {
        //
    }
}
