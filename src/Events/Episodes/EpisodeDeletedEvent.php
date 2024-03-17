<?php

namespace Eduka\Cube\Events\Episodes;

class EpisodeDeletedEvent
{
    public $payload;

    public function __construct(array $payload)
    {
        $this->payload = $payload;
    }
}
