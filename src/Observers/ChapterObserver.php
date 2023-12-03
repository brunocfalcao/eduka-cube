<?php

namespace Eduka\Cube\Observers;

use Brunocfalcao\LaravelHelpers\Traits\CanValidateObserverAttributes;
use Eduka\Cube\Models\Chapter;

class ChapterObserver
{
    use CanValidateObserverAttributes;

    public function saving(Chapter $chapter)
    {
        $this->validate($chapter, [
            'name' => ['required', 'string', 'min:1', 'max:255'],
            'description' => ['nullable']
        ]);
    }
}
