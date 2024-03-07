<?php

namespace Eduka\Cube\Events\Videos;

use Eduka\Cube\Models\Video;

class VideoChapterUpdatedEvent
{
    public Video $video;

    public $previousChapterId;

    public function __construct(Video $video)
    {
        $this->video = $video;
        $this->previousChapterId = $video->getOriginal('chapter_id');
    }
}
