<?php

namespace Eduka\Cube\Observers;

use Eduka\Cube\Events\Courses\CourseCreatedEvent;
use Eduka\Cube\Events\Courses\CourseDeletedEvent;
use Eduka\Cube\Events\Courses\CourseRenamedEvent;
use Eduka\Cube\Events\Courses\CourseUpdatedEvent;
use Eduka\Cube\Models\Course;

class CourseObserver
{
    public function saving(Course $course)
    {
        $course->upsertCanonical();
        $course->upsertUuid();
        $course->validate();
    }

    public function created(Course $course)
    {
        event(new CourseCreatedEvent($course));
    }

    public function updated(Course $course)
    {
        $course->wasChanged('name') &&
        event(new CourseRenamedEvent($course));

        event(new CourseUpdatedEvent($course));
    }

    public function deleted(Course $course)
    {
        event(new CourseDeletedEvent($course));
    }
}
