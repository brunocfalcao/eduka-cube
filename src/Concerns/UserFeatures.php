<?php

namespace Eduka\Cube\Concerns;

trait UserFeatures
{
    /**
     * Marks a user video as seen. Uses a special method that will sync
     * this video id and remove any other entries where the user_id/video_id
     * is present (and keep the most updated one).
     */
    public function markAsSeen(Video $video)
    {
        $this->videosThatWereSeen()->syncOnlyThese($video->id);
    }
}
