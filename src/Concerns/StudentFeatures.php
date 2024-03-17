<?php

namespace Eduka\Cube\Concerns;

trait StudentFeatures
{
    /**
     * Marks a student episode as seen. Uses a special method that will sync
     * this episode id and remove any other entries where the student_id/episode_id
     * is present (and keep the most updated one).
     */
    public function markAsSeen(Episode $episode)
    {
        $this->episodesThatWereSeen()->syncOnlyThese($episode->id);
    }
}
