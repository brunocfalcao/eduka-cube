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
            'prelaunched_at' => [
                'nullable',
                Rule::when($course->launched_at !== null, 'before:launched_at'),
            ],
            'launched_at' => [
                'nullable',
                Rule::when($course->prelaunched_at !== null, 'after:prelaunched_at'),
            ],
            'retired_at' => [
                'nullable',
                Rule::when($course->launched_at !== null, 'after:launched_at'),
            ],
        ];

        $course->validate($extraValidationRules);
    }

    public function created(Course $course)
    {
        event(new CourseCreatedEvent($course));
    }

    public function updated(Course $course)
    {
        if ($course->wasChanged('name')) {
            event(new CourseRenamedEvent($course));
        }

        event(new CourseUpdatedEvent($course));
    }
}
