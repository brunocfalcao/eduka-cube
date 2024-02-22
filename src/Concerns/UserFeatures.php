<?php

namespace Eduka\Cube\Concerns;

trait UserFeatures
{
    public function markAsSeen(Video $video)
    {
        $this->videosThatWereSeen()->syncOnlyThese($video->id);
    }
}
