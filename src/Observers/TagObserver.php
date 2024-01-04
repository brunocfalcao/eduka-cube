<?php

namespace Eduka\Cube\Observers;

use Brunocfalcao\LaravelHelpers\Traits\CanValidateObserverAttributes;
use Eduka\Cube\Models\Tag;

class TagObserver
{
    use CanValidateObserverAttributes;

    public function saving(Tag $tag)
    {
        $validationRules = [
            'name' => ['required', 'string'],
            'description' => ['nullable'],
            'course_id' => ['required', 'exists:courses,id'],
        ];

        $this->validate($tag, $validationRules);
    }
}
