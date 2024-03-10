<?php

namespace Eduka\Cube\Events\Chapters;

use Eduka\Cube\Models\Chapter;

class ChapterDeletedEvent
{
    public $chapter;

    public function __construct(Chapter $chapter)
    {
        $this->chapter = $chapter;
    }
}
