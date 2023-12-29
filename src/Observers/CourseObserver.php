<?php

namespace Eduka\Cube\Observers;

use Brunocfalcao\LaravelHelpers\Traits\CanValidateObserverAttributes;
use Eduka\Cube\Concerns\UsesCanonicals;
use Eduka\Cube\Models\Course;
use Illuminate\Validation\Rule;

class CourseObserver
{
    use CanValidateObserverAttributes, UsesCanonicals;

    public function saving(Course $course)
    {
        $this->checkCanonical($course);

        $this->validate($course, [
        'name' => 'required',
        'canonical' => ['required', Rule::unique('courses')->ignore($course->id)],
        'admin_name' => 'required',
        'admin_email' => 'required',
        'provider_namespace' => 'required',
        'launched_at' => 'date',
        'enable_purchase_power_parity' => 'boolean',
        'is_decommissioned' => 'boolean',
        ]);
    }
}
