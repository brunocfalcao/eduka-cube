<?php

namespace Eduka\Cube\Observers;

use Brunocfalcao\LaravelHelpers\Traits\CanValidateObserverAttributes;
use Eduka\Cube\Models\Link;

class LinkObserver
{
    use CanValidateObserverAttributes;

    public function saving(Link $link)
    {
        $validationRules = [
            'name' => ['required', 'string'],
            'url' => ['required', 'string'],
            'video_id' => ['required', 'exists:videos,id'],
        ];

        $this->validate($link, $validationRules);
    }
}
