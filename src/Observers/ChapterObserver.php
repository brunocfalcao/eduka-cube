<?php

namespace Eduka\Cube\Observers;

use Eduka\Cube\Models\Chapter;
use Eduka\Cube\Traits\HasIndexIncrements;
use Eduka\Cube\Traits\HasUuids;

class ChapterObserver
{
    use HasIndexIncrements;
    use HasUuids;

    /**
     * Handle the Chapter "saving" event.
     *
     * @param  \App\Models\Eduka\Models\Chapter  $chapter
     * @return void
     */
    public function saving(Chapter $chapter)
    {
        $this->checkIndex($chapter, 'index', $chapter->product());
        $this->checkUuid($chapter);
    }
}
