<?php

namespace Eduka\Cube\Observers;

use Brunocfalcao\LaravelHelpers\Traits\CanValidateObserverAttributes;
use Eduka\Cube\Models\Tag;

class TagObserver
{
    use CanValidateObserverAttributes;

    public function saving(Tag $tag)
    {
        $this->validate($tag, [
            'name' => 'required',
        ]);
    }
}
