<?php

namespace Eduka\Cube\Events\Episodes;

use Eduka\Cube\Models\Episode;

class EpisodeUpdatedEvent
{
    public Episode $episode;

    public function __construct(Episode $episode)
    {
        $this->episode = $episode;
    }
}
