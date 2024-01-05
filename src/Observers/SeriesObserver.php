<?php

namespace Eduka\Cube\Observers;

use Brunocfalcao\LaravelHelpers\Traits\CanValidateObserverAttributes;
use Eduka\Cube\Models\Series;

class SeriesObserver
{
    use CanValidateObserverAttributes;

    public function saving(Series $series)
    {
        $validationRules = [
            'name' => ['required', 'string'],
            'description' => ['nullable'],
            'course_id' => ['required', 'exists:courses,id'],
        ];

        $this->validate($series, $validationRules);
    }
}
