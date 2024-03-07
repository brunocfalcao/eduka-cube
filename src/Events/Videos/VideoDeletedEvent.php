<?php

namespace Eduka\Cube\Events\Videos;

class VideoDeletedEvent
{
    public $payload;

    public function __construct(array $payload)
    {
        $this->payload = $payload;
    }
}
