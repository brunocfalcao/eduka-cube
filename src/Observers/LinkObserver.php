<?php

namespace Eduka\Cube\Observers;

use Brunocfalcao\LaravelHelpers\Traits\CanValidateObserverAttributes;
use Eduka\Cube\Models\Link;

class LinkObserver
{
    use CanValidateObserverAttributes;

    public function saving(Link $link)
    {
        $this->validate($link, [
            'name' => ['required', 'string', 'min:1', 'max:255'],
            'url' => ['required', 'string', 'min:1', 'max:255'],
            'video_id' => ['required', 'exists:videos,id']
        ]);
    }
}
