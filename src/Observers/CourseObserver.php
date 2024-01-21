<?php

namespace Eduka\Cube\Observers;

use Brunocfalcao\LaravelHelpers\Traits\HasCanonicals;
use Eduka\Cube\Events\Courses\CourseCreatedEvent;
use Eduka\Cube\Events\Courses\CourseRenamedEvent;
use Eduka\Cube\Events\Courses\CourseUpdatedEvent;
use Eduka\Cube\Models\Course;
use Illuminate\Validation\Rule;

class CourseObserver
{
    use HasCanonicals;

    public function saving(Course $course)
    {
        $this->upsertCanonical($course, $course->name);

        $extraValidationRules = [
            'canonical' => ['required', Rule::unique('courses')->ignore($course->id)],
            'domain' => ['required', 'string', Rule::unique('courses')->ignore($course->id)],
        ];

        $course->validate($extraValidationRules);
    }

    public function created(Course $course)
    {
        if (config('eduka.events.observers') === true) {
            event(new CourseCreatedEvent($course));
        }
    }

    public function updated(Course $course)
    {
        if ($course->wasChanged('name')) {
            if (config('eduka.events.observers') === true) {
                event(new CourseRenamedEvent($course));
            }
        }

        if (config('eduka.events.observers') === true) {
            event(new CourseUpdatedEvent($course));
        }
    }
}
