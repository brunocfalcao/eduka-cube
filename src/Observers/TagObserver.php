<?php

namespace Eduka\Cube\Observers;

use Eduka\Cube\Models\Tag;

class TagObserver
{
    public function saving(Tag $tag)
    {
        $tag->validate();
    }
}
