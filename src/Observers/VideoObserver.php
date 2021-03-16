<?php

namespace Eduka\Cube\Observers;

use Eduka\Cube\Models\Video;
use Eduka\Cube\Traits\HasIndexIncrements;
use Eduka\Cube\Traits\HasUuids;

class VideoObserver
{
    use HasIndexIncrements;
    use HasUuids;

    /**
     * Handle the Video "saving" event.
     *
     * @param  \App\Models\Eduka\Models\Video  $video
     * @return void
     */
    public function saving(Video $video)
    {
        $this->checkIndex($video, 'index', $video->chapter());
        $this->checkUuid($video);
    }
}
