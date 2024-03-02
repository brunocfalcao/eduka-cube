<?php

namespace Eduka\Cube\Events\Chapters;

class ChapterDeletedEvent
{
    public $payload;

    public function __construct(array $payload)
    {
        $this->payload = $payload;
    }
}
