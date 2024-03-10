<?php

namespace Eduka\Cube\Events\Videos;

use Eduka\Cube\Models\Video;

class VideoChapterUpdatedEvent
{
    public Video $video;

    public function __construct(Video $video)
    {
        $this->video = $video;
    }
}
