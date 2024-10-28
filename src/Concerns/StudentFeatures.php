<?php

namespace Eduka\Cube\Concerns;

use Eduka\Cube\Models\Episode;

trait StudentFeatures
{
    /**
     * Marks a student episode as seen. Uses a special method that will sync
     * this episode id and remove any other entries where the student_id/episode_id
     * is present (and keep the most updated one).
     */
    public function markEpisodeAsSeen(Episode $episode)
    {
        $this->episodesThatWereSeen()->attach($episode->id);
    }

    public function unmarkEpisodeAsSeen(Episode $episode)
    {
        $this->episodesThatWereSeen()->detach($episode->id);
    }

    public function isEpisodeSeen(Episode $episode)
    {
        return $this->episodesThatWereSeen()->where('episodes.id', $episode->id)->exists();
    }

    public function bookmarkEpisode(Episode $episode)
    {
        $this->episodesThatWereBookmarked()->attach($episode->id);
    }

    public function unbookmarkEpisode(Episode $episode)
    {
        $this->episodesThatWereBookmarked()->detach($episode->id);
    }

    public function isEpisodeBookmarked(Episode $episode)
    {
        return $this->episodesThatWereBookmarked()->where('episodes.id', $episode->id)->exists();
    }
}
