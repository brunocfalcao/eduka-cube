<?php

namespace Eduka\Cube\Observers;

use Brunocfalcao\LaravelHelpers\Traits\CanValidateObserverAttributes;
use Eduka\Cube\Models\Course;

class CourseObserver
{
    use CanValidateObserverAttributes;

    public function saving(Course $course)
    {
        $this->validate($course, [
            'name' => 'required',
            'canonical' => 'required|unique:courses',
            'admin_name' => 'required',
            'admin_email' => 'required',
            'provider_namespace' => 'required',
        ]);
    }
}
